<?php

use oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2\Contact;

require_once "Secure_area.php";
require_once APPPATH . "models/cart/PHPPOSCartSale.php";
require_once APPPATH . "traits/taxOverrideTrait.php";
require_once APPPATH . "traits/creditcardProcessingTrait.php";
require_once APPPATH . "traits/emailSalesReceiptTrait.php";
require_once APPPATH . "libraries/Fatoora.php";
require_once(APPPATH . "traits/saleTrait.php");



class Billing extends Secure_area
{
    use taxOverrideTrait,
        creditcardProcessingTrait,
        emailSalesReceiptTrait;

    private $api_url;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['form','url']);
        $this->load->library('session');
        $this->load->model(['Sucursal_model', 'PuntoVenta_model']);

        // Carga tu librería de cURL si la tienes, sino usa directamente curl_exec
        $this->api_url = 'http://localhost:8080/facturacion/api/factura/funcionesFactura.php';
    }

  

    // 1. Listado de facturas
    public function index()
    {
        $inicio = $this->input->post('fecha_inicio') ?? date('Y-m-01');
        $fin    = $this->input->post('fecha_fin')    ?? date('Y-m-d');

        if ($inicio > $fin) {
            $this->session->set_flashdata('error', 'La fecha inicial no puede ser mayor a la final');
            redirect('billing/index');
        }

        $facturas = [];
        $resp = $this->call_api([
            'funcion'     => 'listarFacturas',
            'ids'         => '1',
            'fechainicio' => $inicio,
            'fechafin'    => $fin
        ]);
        if (isset($resp['facturas'])) {
            $facturas = $resp['facturas'];
        } else {
            $this->session->set_flashdata('error', $resp['error'] ?? 'Error al listar facturas');
        }

        $this->load->view('billing/index', [
            'facturas'    => $facturas,
            'fechainicio' => $inicio,
            'fechafin'    => $fin
        ]);
    }

    // 2. Ver / Descargar PDF
    public function ver_pdf($idfac = null)
    {
        if (!$idfac) {
            $this->session->set_flashdata('error', 'Factura no identificada');
            redirect('billing/index');
        }

        // Generar el PDF en el servidor de la API
        $pdfOk = $this->call_api([
            'funcion' => 'generarFacturaPdf',
            'idfac'   => $idfac
        ]);

        if (empty($pdfOk) || $pdfOk === false) {
            $this->session->set_flashdata('error', 'No se pudo generar el PDF');
            redirect('billing/index');
        }

        // Obtener el CUF para localizar el archivo
        $detalle = $this->call_api([
            'funcion' => 'listarFacturas',
            'ids'     => '1',
            'fechainicio' => date('Y-m-d'),
            'fechafin'    => date('Y-m-d')
        ]);
        // mejor: traer por idfac, pero la API no filtra por idfac en listarFacturas
        $factura = null;
        foreach ($detalle['facturas'] ?? [] as $f) {
            if ($f['id'] == $idfac) { $factura = $f; break; }
        }
        if (!$factura || empty($factura['cuf'])) {
            $this->session->set_flashdata('error', 'No se encontró CUF para la factura');
            redirect('billing/index');
        }

        $path = FCPATH . "Siat/temp/factura-{$factura['cuf']}.pdf";
        if (!file_exists($path)) {
            $this->session->set_flashdata('error', 'Archivo PDF no encontrado');
            redirect('billing/index');
        }

        header('Content-Type: application/pdf');
        readfile($path);
        exit;
    }

    // 3. Enviar por email
    public function enviar_email($idfac)
    {
        // Obtener datos de factura
        $resp = $this->call_api([
            'funcion' => 'listarFacturas',
            'ids'     => '1',
            'fechainicio' => date('Y-m-d'),
            'fechafin'    => date('Y-m-d')
        ]);
        $factura = null;
        foreach ($resp['facturas'] ?? [] as $f) {
            if ($f['id'] == $idfac) { $factura = $f; break; }
        }

        if (!$factura || empty($factura['email'])) {
            $this->session->set_flashdata('error', 'No hay correo electrónico disponible para esta factura');
            redirect('billing/index');
        }

        $res = $this->call_api([
            'funcion' => 'enviarMailFactura',
            'mail'    => $factura['email'],
            'rzs'     => $factura['nombreRazonSocial'],
            'nit'     => $factura['numeroDocumento'],
            'cuf'     => $factura['cuf']
        ]);
        if (isset($res['correo'])) {
            $this->session->set_flashdata('success', 'Factura enviada por email');
        } else {
            $this->session->set_flashdata('error', $res['error'] ?? 'Error al enviar email');
        }

        redirect('billing/index');
    }

    // 4. Anular factura
    public function anular_factura($idfac)
    {
        $res = $this->call_api([
            'funcion' => 'anularFactura',
            'ids'     => '1',
            'idf'     => $idfac,
            'motivo'  => '1'
        ]);
        if (!empty($res) && ($res === true || isset($res['res']) && $res['res'] === true)) {
            $this->session->set_flashdata('success', 'Factura anulada correctamente');
        } else {
            $this->session->set_flashdata('error', $res['error'] ?? 'Error al anular factura');
        }
        redirect('billing/index');
    }
   ////
    // FACTURAR
    public function facturar($sale_id = null)
    {
        $this->load->model(['Item', 'Sale']);

        $productos = $this->Item->get_all();

        // Variables por defecto para facturación manual
        $razon_social = '';
        $nit = '';
        $email = '';
        $facturas = [];
        $subtotal = 0.00;
        $descuento_total = 0.00;
        $total = 0.00;

        // Si viene un sale_id, entonces cargamos los datos automáticamente
        if ($sale_id) {
            $venta = $this->Sale->get_detalle_venta_completo($sale_id);
            if (empty($venta)) {
                show_error('Venta no encontrada', 404);
            }

            $cliente = $venta[0];
            $nombre = trim("{$cliente->name} {$cliente->last_name}");
            $razon_social = $cliente->cliente_razon_social ?: $nombre;
            $nit = $cliente->cliente_nit;
            $email = $cliente->email;
            $subtotal = $cliente->subtotal;
            $total = $cliente->total;

            foreach ($venta as $p) {
                if (!$p->item_id) continue;

                $m_desc = $p->item_unit_price * $p->quantity_purchased * ($p->discount_percent / 100);
                $neg_subt = $p->item_subtotal < 0 ? abs($p->item_subtotal) : 0;
                $descuento_total += $m_desc + $neg_subt;

                $facturas[] = [
                    'codigo' => $p->item_id,
                    'cantidad' => (float)$p->quantity_purchased,
                    'descripcion' => $p->item_nombre,
                    'preciounitario' => (float)$p->item_unit_price,
                    'descuento' => (float)$p->discount_percent,
                    'subtotal' => (float)$p->item_subtotal,
                ];
            }
        }

        // Carga la vista con valores manuales o precargados
        $this->load->view('billing/facturar', [
            'razon_social' => $razon_social,
            'nit' => $nit,
            'email' => $email,
            'facturas' => $facturas,
            'subtotal' => $subtotal,
            'descuento' => $descuento_total,
            'total' => $total,
            'productos' => $productos
        ]);
    }

    ////

    // CODIGOS
    public function codigos()
    {
        $resp = $this->call_api(['funcion' => 'listarCodigos', 'ids' => '1']);
        $this->load->view('billing/codigos', [
            'cufds' => $resp['cufds']['data'] ?? [],
            'cuis' => $resp['cuiss']['data'] ?? []
        ]);
    }
    public function sincronizar_cufd()
    {
        $this->call_api(['funcion' => 'sincronizarCufd', 'ids' => '1']);
        redirect('billing/codigos');
    }
    public function sincronizar_cuis()
    {
        $this->call_api(['funcion' => 'sincronizarSiat', 'valor' => 1, 'ids' => '1']);
        redirect('billing/codigos');
    }
    ////

    // CONFIGURACION
    public function configuracion()
    {
        $this->load->view('billing/configuracion');
    }
    public function editarConfiguracion()
    {
        $this->load->view('billing/editarConfiguracion');
    }
    public function guardarConfiguracion()
    {
        redirect('billing/configuracion');
    }
    ////

    // SUCURSALES
  

public function sucursales()
{
    // ——— Sincronización y guardado de sucursales ———
    $resp = $this->call_api(['funcion' => 'listarSucursales']);
    $datos_api = $resp['sucursales']['data'] ?? [];
    foreach ($datos_api as $s) {
        $this->Sucursal_model->guardar_o_actualizar([
            'codigo_sucursal' => $s['codigoSucursal'],
            'nombre'          => $s['nombreSucursal'],
            'direccion'       => $s['direccionSucursal'],
            'responsable'     => $s['responsableSucursal'],
            'telefono'        => $s['telefonoSucursal'],
            'celular'         => $s['celularSucursal'],
        ]);
    }

    // ——— Obtener desde BD local ———
    $sucursales = $this->Sucursal_model->obtener_todas();

    // ——— Sincronización y guardado de puntos de venta ———
    // Llamada API para traerlos
    $resp2 = $this->call_api(['funcion' => 'sincronizarPos', 'nroSucursal' => 0]);
    $datos_pv = $resp2['puntosVenta']['data'] ?? [];
    foreach ($datos_pv as $pv) {
        // necesitas mapear id_sucursal local: buscá el registro por codigo_sucursal
        $suc_local = $this->db
            ->where('codigo_sucursal', $pv['nroSucursal'])
            ->get('sucursales_siat')
            ->row();
        if (!$suc_local) continue;
        $this->PuntoVenta_model->guardar_o_actualizar([
            'id_sucursal'      => $suc_local->id,
            'nro_punto_venta'  => $pv['nroPuntoVenta'],
            'nombre'           => $pv['nombrePuntoVenta'],
            'tipo_punto_venta' => $pv['tipoPuntoVenta'],
            'tipo_emision'     => $pv['tipoEmision'],
        ]);
    }

    // ——— Obtener todos los puntos de venta ya guardados ———
    $puntos = $this->PuntoVenta_model->obtener_todos();

    // ——— Cargar la vista ———
    $this->load->view('billing/sucursales', [
        'sucursales' => $sucursales,
        'puntos'     => $puntos
    ]);
}


    public function sincronizar_sucursales()
    {
        $this->call_api(['funcion' => 'listarSucursales']);
        redirect('billing/sucursales');
    }
    public function sincronizar_puntos()
{
    $this->load->model('PuntoVenta_model');
    $resp = $this->call_api(['funcion' => 'sincronizarPos', 'nroSucursal' => 0]);
    $datos_api = $resp['puntos']['data'] ?? [];

    foreach ($datos_api as $p) {
        // Buscar id_sucursal localmente por el código
        $sucursal = $this->db
            ->where('codigo_sucursal', $p['nroSucursal'])
            ->get('sucursales_siat')
            ->row();

        if ($sucursal) {
            $this->PuntoVenta_model->guardar_o_actualizar([
                'id_sucursal'      => $sucursal->id,
                'nro_punto_venta'  => $p['nroPuntoVenta'],
                'nombre'           => $p['nombrePuntoVenta'],
                'tipo_punto_venta' => $p['tipoPuntoVenta'],
                'tipo_emision'     => $p['tipoEmision']
            ]);
        }
    }

    redirect('billing/sucursales#puntosDeVenta');
}

    public function nuevaSucursal()
    {
        $this->load->view('billing/crearSucursal');
    }
    public function crearSucursal()
    {
        $pl = ['funcion' => 'newSucursal', 'sucursal' => $this->input->post('sucursal'), 'direccion' => $this->input->post('direccion'), 'responsable' => $this->input->post('responsable'), 'telefono' => $this->input->post('telefono'), 'celular' => $this->input->post('celular')];
        if ($n = $this->input->post('nroSucursal')) $pl['nroSucursal'] = $n;
        if ($c = $this->input->post('codigoSucursal')) $pl['codigoSucursal'] = $c;
        $resp = $this->call_api($pl);
        $ok = !empty($resp['ok']);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Sucursal creada' : 'Error creando sucursal');
        redirect('billing/sucursales#sucursales');
    }
    public function editarSucursal()
    {
        $this->load->view('billing/editarSucursal');
    }
    public function crearPuntoVenta()
    {
        $this->load->view('billing/crearPuntoVenta');
    }

    // Sincronización general
    public function sincronizacion()
    {
        $this->load->view('billing/sincronizacion');
    }
    public function sincronizar()
    {
        $resp = $this->call_api(['funcion' => 'sincronizarActividades', 'codigo' => '123456']);
        $ok = !empty($resp['estado']);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Sincronización exitosa' : 'Error sincronizando');
        redirect('billing/index');
    }
    ////
    
    // EVENTOS
    public function eventos()
    {
        $resp = $this->call_api(['funcion' => 'listarEventos', 'ids' => '1']);
        $this->load->view('billing/eventos', ['eventos' => $resp['eventos']['data'] ?? []]);
    }
    public function nuevoEvento()
    {
        $resp = $this->call_api(['funcion' => 'listarPos']);
        $this->load->view('billing/crearEvento', ['pos' => $resp['pos']['data'] ?? []]);
    }
    public function crearEvento()
    {
        $pl = ['funcion' => 'newEventoSignificativo', 'ids' => '1', 'nroPuntoVenta' => $this->input->post('punto_de_venta'), 'tipoEvento' => $this->input->post('tipo_evento')];
        $resp = $this->call_api($pl);
        $ok = !empty($resp['transaccion']);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Evento creado' : 'Error creando evento');
        redirect('billing/eventos');
    }
    

    // HELPER: Llama a la API con timeout y logging
    private function call_api(array $params)
    {
        $ch = curl_init($this->api_url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS     => json_encode($params)
        ]);
        $raw  = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err  = curl_error($ch);
        curl_close($ch);

        if ($err || $code !== 200) {
            log_message('error', "API ERROR [{$code}]: {$err} | Response: {$raw}");
            return ['error' => 'Error de conexión con la API'];
        }

        $json = json_decode($raw, true);
        return $json ?: ['error' => 'Respuesta inválida del servidor'];
    }
    ////
}
