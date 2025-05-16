<?php

use oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2\Contact;

require_once "Secure_area.php";
require_once APPPATH . "models/cart/PHPPOSCartSale.php";
require_once APPPATH . "traits/taxOverrideTrait.php";
require_once APPPATH . "traits/creditcardProcessingTrait.php";
require_once APPPATH . "traits/emailSalesReceiptTrait.php";
require_once APPPATH . "libraries/Fatoora.php";

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
        $this->api_url = 'http://localhost:8080/facturacion/api/factura/funcionesFactura.php';
    }

    // LISTADO DE FACTURAS
    public function index() {
        $inicio = $this->input->post('fecha_inicio') ?? date('Y-m-01');
        $fin    = $this->input->post('fecha_fin')    ?? date('Y-m-d');

        // Validación de fechas
        if ($inicio > $fin) {
            $this->session->set_flashdata('error', 'La fecha inicial no puede ser mayor a la final');
            redirect('billing/index');
        }

        try {
            $resp = $this->call_api([
                'funcion'     => 'listarFacturas',
                'ids'         => '1',
                'fechainicio' => $inicio,
                'fechafin'    => $fin
            ]);
            
            $facturas = $resp['facturas'] ?? [];
        } catch (Exception $e) {
            log_message('error', 'Error API: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Error al conectar con el servicio de facturación');
            $facturas = [];
        }

        $this->load->view('billing/index', [
            'facturas'    => $facturas,
            'fechainicio' => $inicio,
            'fechafin'    => $fin
        ]);
    }

    // Generar y mostrar PDF
    public function ver_pdf($idfac = null) {
        $idfac = $idfac ?: $this->session->userdata('idfac');
        if (!$idfac) {
            $this->session->set_flashdata('error', 'Factura no identificada');
            redirect('billing/index');
        }

        try {
            // Paso 1: Generar PDF
            $this->call_api(['funcion' => 'generarFacturaPdf', 'idfac' => $idfac]);
            
            // Paso 2: Obtener CUF
            $factura = $this->call_api(['funcion' => 'listarFacturas', 'idfac' => $idfac])['facturas'][0] ?? [];
            if (empty($factura['cuf'])) {
                throw new Exception("Código CUF no disponible");
            }
            $pdf_path = FCPATH . "Siat/temp/factura-{$factura['cuf']}.pdf";
            if (!file_exists($pdf_path)) {
                throw new Exception("Archivo PDF no generado");
            }

            header('Content-Type: application/pdf');
            readfile($pdf_path);
            exit;
        } catch (Exception $e) {
            log_message('error', 'Error PDF: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'No se pudo generar el PDF: ' . $e->getMessage());
            redirect('billing/index');
        }
    }

    // Enviar por Email
    public function enviar_email($idfac) {
        try {
            $factura = $this->call_api(['funcion' => 'listarFacturas', 'idfac' => $idfac])['facturas'][0] ?? null;
            if (!$factura) {
                throw new Exception("Factura no encontrada");
            }

            $resp = $this->call_api([
                'funcion' => 'enviarMailFactura',
                'mail'    => $factura['email'],
                'rzs'     => $factura['nombreRazonSocial'],
                'nit'     => $factura['numeroDocumento'],
                'cuf'     => $factura['cuf']
            ]);
            

            if (isset($resp['error'])) {
                throw new Exception($resp['error']);
            }

            $this->session->set_flashdata('success', 'Email enviado correctamente');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
        }
        redirect('billing/index');
    }

    // Anular Factura
    public function anular_factura($idfac) {
        try {
            $resp = $this->call_api([
                'funcion' => 'anularFactura',
                'ids'     => '1', 
                'idf'     => $idfac,
                'motivo'  => '1' // Ajustar según catálogo SIAT
            ]);

            if (empty($resp['res'])) {
                throw new Exception("Respuesta inválida del servidor");
            }

            $this->session->set_flashdata('success', 'Factura anulada correctamente');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error al anular: ' . $e->getMessage());
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
    { /* validar y guardar */
        redirect('billing/configuracion');
    }
    ////

    // SUCURSALES
    public function sucursales()
    {
        $resp = $this->call_api(['funcion' => 'listarSucursales']);
        $this->load->view('billing/sucursales', ['sucursales' => $resp['sucursales']['data'] ?? []]);
    }
    public function sincronizar_sucursales()
    {
        $this->call_api(['funcion' => 'listarSucursales']);
        redirect('billing/sucursales');
    }
    public function sincronizar_puntos()
    {
        $this->call_api(['funcion' => 'sincronizarPos', 'nroSucursal' => 0]);
        redirect('billing/sucursales');
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

    // HELPER
    private function call_api(array $p)
    {
        $ch = curl_init($this->api_url);
        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => ['Content-Type: application/json'], CURLOPT_POSTFIELDS => json_encode($p)]);
        $raw = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err  = curl_error($ch);
        curl_close($ch);
        if ($err) {
            log_message('error', 'API-CURL: ' . $err);
            return ['error' => 'Comunicación fallida'];
        }
        if ($code !== 200) {
            log_message('error', 'API-HTTP ' . $code . ': ' . $raw);
            return ['error' => 'HTTP ' . $code];
        }
        return json_decode($raw, true) ?: ['error' => 'JSON inválido'];
    }
    ////
}
