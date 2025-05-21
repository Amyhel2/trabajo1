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
        $this->load->helper(['form', 'url']);
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
            if ($f['id'] == $idfac) {
                $factura = $f;
                break;
            }
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
            if ($f['id'] == $idfac) {
                $factura = $f;
                break;
            }
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
    // CUFD BD local
    $cufdsLocal = $this->Cufd_model->obtener_todos();

    // Si no hay nada en BD, leer directo de API
    if (empty($cufdsLocal)) {
        $resp = $this->call_api(['funcion'=>'listarCodigos','ids'=>'1']);
        $cufdsLocal = $resp['cufds']['data'] ?? [];
    }

    // CUIS API
    $resp2 = $this->call_api(['funcion'=>'listarCodigos','ids'=>'1']);
    $cuis = $resp2['cuiss']['data'] ?? [];

    $this->load->view('billing/codigos', [
        'cufds' => $cufdsLocal,
        'cuis'  => $cuis
    ]);
}

    /**
     * Sincroniza un nuevo CUFD: llama API, luego guarda en BD local
     */
    public function sincronizar_cufd()
    {
        // 1) Generar CUFD en API
        $this->call_api(['funcion' => 'sincronizarCufd', 'ids' => '1']);

        // 2) Recuperar todos los códigos (incluyendo el nuevo)
        $resp = $this->call_api(['funcion' => 'listarCodigos', 'ids' => '1']);
        $cufdsApi = $resp['cufds']['data'] ?? [];

        // 3) Guardar cada uno en BD local
        foreach ($cufdsApi as $cufd) {
            $this->Cufd_model->guardar([
                'codigo_cufd'     => $cufd['codigoCufd'],
                'codigo_control'  => $cufd['codigoControl'],
                'fecha_registro'  => $cufd['fechaRegistro'],
                'fecha_vigencia'  => $cufd['fechaVigencia'],
                'nro_sucursal'    => $cufd['nroSucursal'],
                'nro_punto_venta' => $cufd['nroPuntoVenta'],
                'estado'          => $cufd['estado']
            ]);
        }

        // 4) Feedback y redirección
        $this->session->set_flashdata('success', 'CUFD sincronizado correctamente.');
        redirect('billing/codigos');
    }

    /**
     * Sincroniza un nuevo CUIS (puede renombrarse luego)
     */
    public function sincronizar_cuis()
    {
        $resp = $this->call_api(['funcion' => 'sincronizarSiat', 'valor' => 1, 'ids' => '1']);
        $ok = !empty($resp['ok']);
        $this->session->set_flashdata(
            $ok ? 'success' : 'error',
            $ok ? 'CUIS sincronizado correctamente.' : 'Error al sincronizar CUIS.'
        );
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
        // 1. Listar Sucursales desde la API
        $respSuc      = $this->call_api(['funcion' => 'listarSucursales']);
        $sucursalesApi = $respSuc['sucursales']['data'] ?? [];
        foreach ($sucursalesApi as $s) {
            $this->Sucursal_model->guardar_o_actualizar([
                'codigo_sucursal' => $s['codigoSucursal'],
                'nombre'          => $s['nombreSucursal'],
                'direccion'       => $s['direccionSucursal'],
                'responsable'     => $s['responsableSucursal'],
                'telefono'        => $s['telefonoSucursal'],
                'celular'         => $s['celularSucursal'],
            ]);
        }

        // 2. Listar Puntos de Venta (POS) desde la API — clave 'pos'
        $respPdv = $this->call_api(['funcion' => 'listarPos']);
        $posApi  = $respPdv['pos']['data'] ?? [];
        foreach ($posApi as $pv) {
            // Buscar el ID interno de la sucursal por su código
            $s = $this->db
                ->where('codigo_sucursal', $pv['nroSucursal'])
                ->get('sucursales_siat')
                ->row();

            $this->PuntoVenta_model->guardar_o_actualizar([
                'id_sucursal'      => $s->id ?? null,
                'nro_punto_venta'  => $pv['nroPuntoVenta'],
                'nombre'           => $pv['nombrePuntoVenta'],
                'tipo_punto_venta' => $pv['tipoPuntoVenta'],
                'tipo_emision'     => $pv['tipoEmision'],
                // opcional: 'estado' => $pv['estado'], 'api_id' => $pv['id']
            ]);
        }

        // 3. Obtener datos ya guardados en la base local
        $sucursales  = $this->Sucursal_model->obtener_todas();
        $puntosVenta = $this->PuntoVenta_model->obtener_todos();

        // 4. Cargar la vista con las variables que ésta espera
        $this->load->view('billing/sucursales', [
            'sucursales'  => $sucursales,
            'puntosVenta' => $puntosVenta
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

        // 1. Ejecutar sincronización en la API
        $this->call_api(['funcion' => 'sincronizarPos', 'nroSucursal' => 0]);

        // 2. Ahora sí obtener los datos sincronizados
        $resp = $this->call_api(['funcion' => 'listarPos']);
        $datos_api = $resp['pos']['data'] ?? [];

        foreach ($datos_api as $p) {
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
        // 1) Armo el payload para la API
        $payload = [
            'funcion'        => 'newSucursal',
            'nroSucursal'    => $this->input->post('nroSucursal'),
            'codigoSucursal' => $this->input->post('codigoSucursal'),
            'sucursal'       => $this->input->post('sucursal'),
            'direccion'      => $this->input->post('direccion'),
            'responsable'    => $this->input->post('responsable'),
            'telefono'       => $this->input->post('telefono'),
            'celular'        => $this->input->post('celular'),
        ];

        // 2) Llamo a la API
        $resp = $this->call_api($payload);

        // 3) Si la API confirma OK, guardo también localmente
        if (!empty($resp['ok'])) {
            $this->Sucursal_model->guardar_o_actualizar([
                'codigo_sucursal' => $payload['codigoSucursal'],
                'nombre'          => $payload['sucursal'],
                'direccion'       => $payload['direccion'],
                'responsable'     => $payload['responsable'],
                'telefono'        => $payload['telefono'],
                'celular'         => $payload['celular'],
            ]);
            $this->session->set_flashdata('success', 'Sucursal creada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al crear la sucursal.');
        }

        redirect('billing/sucursales');
    }

    public function editarSucursal($id)
    {
        $resp = $this->call_api([
            'funcion'    => 'editSucursal',
            'idsucursal' => $id
        ]);

        if (!isset($resp['sucursal'])) {
            $this->session->set_flashdata('error', 'No se pudo obtener la sucursal');
            redirect('billing/sucursales');
        }

        $data['sucursal'] = (object)[
            'id'        => $resp['sucursal']['id'],
            'nroSucursal' => $resp['sucursal']['nroSucursal'],
            'codigoSucursal' => $resp['sucursal']['codigoSucursal'],
            'nombre'    => $resp['sucursal']['nombreSucursal'],
            'direccion' => $resp['sucursal']['direccionSucursal'],
            'responsable' => $resp['sucursal']['responsableSucursal'],
            'telefono'  => $resp['sucursal']['telefonoSucursal'],
            'celular'   => $resp['sucursal']['celularSucursal']
        ];

        $this->load->view('billing/editarSucursal', $data);
    }

    public function actualizarSucursal()
    {
        $payload = [
            'funcion'     => 'updSucursal',
            'idsucursal'  => $this->input->post('id'),
            'sucursal'    => $this->input->post('sucursal'),
            'direccion'   => $this->input->post('direccion'),
            'responsable' => $this->input->post('responsable'),
            'telefono'    => $this->input->post('telefono'),
            'celular'     => $this->input->post('celular')
        ];

        $resp = $this->call_api($payload);

        if (!empty($resp['ok'])) {
            $this->session->set_flashdata('success', 'Sucursal actualizada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al actualizar la sucursal.');
        }

        redirect('billing/sucursales');
    }


    //Punto de Venta
    public function crearPuntoVenta()
    {
        $this->load->view('billing/crearPuntoVenta');
    }

    public function guardarPuntoVenta()
    {
        $payload = [
            'funcion'         => 'newPos',               // revisa en la doc si es 'newPos'
            'nroSucursal'     => $this->input->post('nroSucursal'),
            'nroPuntoVenta'   => $this->input->post('nroPuntoVenta'),
            'nombrePuntoVenta' => $this->input->post('nombre'),
            'tipoPuntoVenta'  => $this->input->post('tipo_punto_venta'),
            'tipoEmision'     => $this->input->post('tipo_emision'),
        ];

        $resp = $this->call_api($payload);

        if (!empty($resp['ok'])) {
            // convierto nroSucursal → id_sucursal interno
            $s = $this->db->where('codigo_sucursal', $payload['nroSucursal'])
                ->get('sucursales_siat')
                ->row();
            $this->PuntoVenta_model->guardar_o_actualizar([
                'id_sucursal'      => $s->id ?? null,
                'nro_punto_venta'  => $payload['nroPuntoVenta'],
                'nombre'           => $payload['nombrePuntoVenta'],
                'tipo_punto_venta' => $payload['tipoPuntoVenta'],
                'tipo_emision'     => $payload['tipoEmision'],
            ]);
            $this->session->set_flashdata('success', 'Punto de Venta creado correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al crear el Punto de Venta.');
        }

        redirect('billing/sucursales#puntosDeVenta');
    }
    ////

    // SINCRONIZACION
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

    public function sincroizacion()
    {
        $this->load->view('billing/sincronizarGeneral');
    }
}
