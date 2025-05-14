<?php

use oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2\Contact;

require_once("Secure_area.php");
require_once(APPPATH . "models/cart/PHPPOSCartSale.php");
require_once(APPPATH . "traits/taxOverrideTrait.php");
require_once(APPPATH . "traits/creditcardProcessingTrait.php");
require_once(APPPATH . "traits/emailSalesReceiptTrait.php");
require_once(APPPATH . "libraries/Fatoora.php");

class Billing extends Secure_area
{
    use taxOverrideTrait;
    use creditcardProcessingTrait;
    use emailSalesReceiptTrait;

    public $cart;
    public $view_data = array();
    private $api_url;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->api_url = 'http://localhost:8080/facturacion/api/factura/funcionesFactura.php';
        $this->load->helper('url');
        $this->load->library('session');
    }

    //LISTAR FACTURAS
    public function index()
    {
        $fechainicio = $this->input->post('fecha_inicio') ?? date('Y-m-01');
        $fechafin = $this->input->post('fecha_fin') ?? date('Y-m-d');

        $request = [
            "funcion" => "listarFacturas",
            "ids" => "1",
            "fechainicio" => $fechainicio,
            "fechafin" => $fechafin
        ];

        $ch = curl_init('http://localhost:8080/facturacion/api/factura/funcionesFactura.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        $this->load->view('billing/index', [
            'facturas'     => $data['facturas'] ?? [],
            'fechainicio'  => $fechainicio,
            'fechafin'     => $fechafin
        ]);
    }

    public function ver_pdf($idfac)
    {
        $payload = [
            'funcion' => 'generarFacturaPdf',
            'idfac'   => $idfac
        ];
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $pdf = curl_exec($ch);
        header('Content-Type: application/pdf');
        echo $pdf;
    }


    public function imprimir_rollo($idfac)
    {

        $this->ver_pdf($idfac);
    }


    public function imprimir_media($idfac)
    {
        $this->ver_pdf($idfac);
    }

    public function ver_xml($idfac)
    {
        $payload = [
            'funcion' => 'generarFacturaXml',
            'idfac'   => $idfac
        ];
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $xml = curl_exec($ch);
        header('Content-Type: application/xml');
        echo $xml;
    }

    public function enviar_email($idfac)
    {

        $factura = $this->call_api([
            'funcion' => 'listarFacturas',
            'ids'     => $idfac
        ])['facturas'][0] ?? null;

        if (!$factura) show_error('Factura no encontrada', 404);

        $payload = [
            'funcion' => 'enviarMailFactura',
            'mail'    => $factura['email'] ?? '',
            'rzs'     => $factura['nombreRazonSocial'],
            'nit'     => $factura['numeroDocumento'],
            'cuf'     => $factura['cuf']
        ];

        $resp = $this->call_api($payload);
        if (!empty($resp['encontrado'])) {
            $this->session->set_flashdata('success', 'Email enviado correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error enviando email.');
        }
        redirect('billing/index');
    }

    public function anular_factura($idfac)
    {
        $payload = [
            'funcion' => 'anularFactura',
            'ids'     => '1',
            'idf'     => $idfac,
            'motivo'  => '1'
        ];

        $resp = $this->call_api($payload);
        if (!empty($resp) && $resp === true) {
            $this->session->set_flashdata('success', 'Factura anulada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al anular la factura.');
        }
        redirect('billing/index');
    }
    //

    public function facturar()
    {
        $this->load->view('billing/facturar');
    }

    //CODIGOS
    public function codigos()
    {
        $payload = ['funcion' => 'listarCodigos', 'ids' => '1'];
        $response = $this->call_api_one($payload);

        $data['cufds'] = isset($response['cufds']['data']) ? $response['cufds']['data'] : [];
        $data['cuis'] = isset($response['cuiss']['data']) ? $response['cuiss']['data'] : [];

        $this->load->view('billing/codigos', $data);
    }

    public function sincronizar_cufd()
    {
        $payload = ['funcion' => 'sincronizarCufd', 'ids' => '1'];
        $this->call_api_one($payload);
        redirect('billing/codigos');
    }

    public function sincronizar_cuis()
    {
        $payload = ['funcion' => 'sincronizarSiat', 'valor' => 1, 'ids' => '1'];
        $this->call_api($payload);
        redirect('billing/codigos');
    }

    private function call_api_one($payload)
    {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $result = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($result, true);
        return is_array($decoded) ? $decoded : [];
    }
    //

    //CONFIGURACION
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
        $this->load->view('billing/configuracion');
    }
    //

    //SUCURSALES
    public function sucursales()
    {
        $suc = $this->call_api([
            'funcion' => 'listarSucursales'
        ]);
        $data['sucursales'] = $suc['sucursales']['data'] ?? [];
        $this->load->view('billing/sucursales', $data);
    }

    public function sincronizar_sucursales()
    {
        $this->call_api([
            'funcion' => 'listarSucursales'
        ]);
        redirect('billing/sucursales');
    }

    public function sincronizar_puntos()
    {
        $this->call_api([
            'funcion'       => 'sincronizarPos',
            'nroSucursal'   => 0
        ]);

        redirect('billing/sucursales');
    }

    private function call_api(array $payload)
    {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true) ?: [];
    }

    public function nuevaSucursal()
    {
        $this->load->view('billing/crearSucursal');
    }

    public function crearSucursal()
    {

        $payload = [
            'funcion'       => 'newSucursal',
            'sucursal'      => $this->input->post('sucursal'),
            'direccion'     => $this->input->post('direccion'),
            'responsable'   => $this->input->post('responsable'),
            'telefono'      => $this->input->post('telefono'),
            'celular'       => $this->input->post('celular'),
            'idsucursal'    => ''
        ];

        if ($this->input->post('nroSucursal')) {
            $payload['nroSucursal']   = $this->input->post('nroSucursal');
        }
        if ($this->input->post('codigoSucursal')) {
            $payload['codigoSucursal'] = $this->input->post('codigoSucursal');
        }

        $response = $this->call_api($payload);

        if (isset($response['ok']) && $response['ok']) {
            $this->session->set_flashdata('success', 'Sucursal creada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al crear sucursal.');
        }

        redirect(site_url('billing/sucursales') . '#sucursales');
    }


    public function editarSucursal()
    {
        $this->load->view('billing/editarSucursal');
    }

    public function crearPuntoVenta()
    {
        $this->load->view('billing/crearPuntoVenta');
    }
    //

    //SINCRONIZACION
    public function sincronizacion()
    {
        $this->load->view('billing/sincronizacion');
    }

    public function sincronizar()
    {
        $data = array(
            'funcion' => 'sincronizarActividades',
            'codigo' => '123456',
        );

        $api_url = 'http://localhost:8080/facturacion/api/factura/funcionesFactura.php';

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Ejecuta la petición
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            log_message('error', 'Error al sincronizar con la API: ' . $error_msg);
            $this->session->set_flashdata('error', 'Error al comunicarse con la API.');
        } elseif ($httpcode != 200) {
            log_message('error', 'La API devolvió HTTP ' . $httpcode);
            $this->session->set_flashdata('error', 'Error al sincronizar: Código ' . $httpcode);
        } else {
            $result = json_decode($response, true);
            if ($result && isset($result['estado']) && $result['estado'] === true) {
                $this->session->set_flashdata('success', 'Sincronización exitosa.');
            } else {
                $this->session->set_flashdata('error', 'Sincronización fallida: ' . print_r($result, true));
            }
        }

        curl_close($ch);

        redirect('billing');
    }
    //

    //EVENTOS 
    public function eventos()
    {
        $request = [
            'funcion' => 'listarEventos',
            'ids'     => '1'
        ];

        $ch = curl_init('http://localhost:8080/facturacion/api/factura/funcionesFactura.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        $response = curl_exec($ch);
        curl_close($ch);

        $decoded = json_decode($response, true);
        $eventos = $decoded['eventos']['data'] ?? [];

        $this->load->view('billing/eventos', [
            'eventos' => $eventos,

        ]);
    }

    public function nuevoEvento()
    {
        $requestPos = ['funcion' => 'listarPos'];
        $ch = curl_init('http://localhost:8080/facturacion/api/factura/funcionesFactura.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestPos));
        $responsePos = curl_exec($ch);
        curl_close($ch);

        $decodedPos = json_decode($responsePos, true);

        $pos = $decodedPos['pos']['data'] ?? [];

        $this->load->view('billing/crearEvento', ['pos' => $pos]);
    }

    public function crearEvento()
    {
        $nroPuntoVenta = $this->input->post('punto_de_venta');
        $tipoEvento     = $this->input->post('tipo_evento');

        $request = [
            'funcion'        => 'newEventoSignificativo',
            'ids'            => '1',
            'nroPuntoVenta'  => $nroPuntoVenta,
            'tipoEvento'     => $tipoEvento
        ];

        $ch = curl_init('http://localhost:8080/facturacion/api/factura/funcionesFactura.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (!empty($result['transaccion']) && $result['transaccion'] === true) {
            $this->session->set_flashdata('success', 'Evento creado correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al crear el evento.');
        }

        redirect('billing/eventos');
    }
    //

    public function list_invoices()
    {

        $this->load->helper('form');
        $start_date = $this->input->post('fechainicio') ?? date('Y-m-01');
        $end_date = $this->input->post('fechafin') ?? date('Y-m-d');

        $request_data = [
            'funcion' => 'listarFacturas',
            'ids' => '1',
            'fechainicio' => $start_date,
            'fechafin' => $end_date
        ];

        $ch = curl_init('http://localhost:8080/facturacion/api/factura/funcionesFactura.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
        $response = curl_exec($ch);
        curl_close($ch);

        $facturas = json_decode($response, true)['facturas'] ?? [];

        $this->load->view('billing/list_invoices', [
            'facturas' => $facturas,
            'fechainicio' => $start_date,
            'fechafin' => $end_date
        ]);
    }

    //FACTURAR
    public function elaborar_factura($sale_id)
{
    $this->load->model('Sale');
    $venta = $this->Sale->get_detalle_venta_completo($sale_id);

    if (!$venta) {
        show_error("Venta no encontrada", 404);
        return;
    }

    // Razón social: company_name o nombre + apellido
    $row0 = $venta[0];
    $nombrePersona = trim($row0->name . ' ' . $row0->last_name);
    $razon_social  = !empty($row0->cliente_razon_social)
                     ? $row0->cliente_razon_social
                     : $nombrePersona;

    // Cliente
    $cliente = (object)[
        'razon_social' => $razon_social,
        'nit'          => $row0->cliente_nit,
        'email'        => $row0->email,
    ];

    // Totales brutos
    $subtotal = $row0->subtotal;
    $total    = $row0->total;

    // Armar detalle y calcular descuento_total
    $facturas        = [];
    $descuento_total = 0.00;

    foreach ($venta as $p) {
        if (empty($p->item_id)) continue;

        // 1) Descuento por %:
        $monto_desc = $p->item_unit_price
                     * $p->quantity_purchased
                     * ($p->discount_percent / 100);
        $descuento_total += $monto_desc;

        // 2) Líneas tipo "Discount" o subtotales negativos:
        if ($p->item_subtotal < 0) {
            // Sumamos el valor absoluto de ese subtotal negativo
            $descuento_total += abs($p->item_subtotal);
        }
         
        $facturas[] = [
            'codigo'         => $p->item_id,
            'cantidad'       => $p->quantity_purchased,
            'descripcion'    => $p->item_nombre,
            'preciounitario' => $p->item_unit_price,
            'descuento'      => $p->discount_percent,
            'subtotal'       => $p->item_subtotal
        ];
    }

    // Pasar a la vista
    $data = [
        'razon_social' => $cliente->razon_social,
        'nit'          => $cliente->nit,
        'email'        => $cliente->email,
        'facturas'     => $facturas,
        'subtotal'     => $subtotal,
        'descuento'    => $descuento_total,  // incluirá ahora también los Bs negativos
        'total'        => $total
    ];

    $this->load->view('billing/facturar', $data);
}

 
}