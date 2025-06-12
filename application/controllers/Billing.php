<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        $this->load->model(['Sucursal_model', 'PuntoVenta_model', 'Billing_model', 'Factura_model']);
        

        // URL base de la API de facturación
        // Por ejemplo: http://localhost:8080/facturacion/api/factura/funcionesFactura.php
        $this->api_url = getenv('API_FACTURA_URL')
                         ?: 'http://localhost:8080/facturacion/api/factura/funcionesFactura.php';
    }

    /**
     * Método genérico para llamar a la API externa de facturación con JSON.
     * Espera siempre 'funcion' dentro de $params, y si aplica, 'ids' (sucursal).
     * @param array $params
     * @return array Respuesta decodificada o ['error'=>...]
     */
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
            $msg = $err ?: "Código HTTP $code";
            log_message('error', "API ERROR [$code]: $msg | Response: $raw");
            return ['error' => "Error de conexión con la API ($msg)"];
        }

        $json = json_decode($raw, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'JSON decode error: ' . json_last_error_msg() . " | Raw: $raw");
            return ['error' => 'Respuesta inválida del servidor'];
        }
        return $json;
    }

    /**
     * Obtiene datos del usuario (sucursal/punto de venta) desde sesión y BD.
     * @return array
     */
    private function _datos_usuario()
    {
        $employee_id = $this->session->userdata('person_id');
        if (!$employee_id) {
            return [
                'sucursal_id'        => null,
                'nombre_empleado'    => 'Desconocido',
                'nombre_sucursal'    => 'No asignada',
                'nombre_punto_venta' => 'No asignado',
                'nro_punto_venta'    => '-'
            ];
        }
        $this->db
            ->select('people.first_name, people.last_name,
                      suc.id AS sucursal_id, suc.nombre AS nombre_sucursal,
                      punto.nombre AS nombre_punto_venta, punto.nro_punto_venta')
            ->from('phppos_people AS people')
            ->join('phppos_sucursal_empleado AS rel', 'people.person_id=rel.employee_id')
            ->join('phppos_sucursales_siat AS suc', 'suc.id=rel.sucursal_id')
            ->join('phppos_puntos_venta_siat AS punto', 'punto.id_sucursal=suc.id')
            ->where('people.person_id', $employee_id)
            ->limit(1);
        $row = $this->db->get()->row();
        if ($row) {
            return [
                'sucursal_id'        => $row->sucursal_id,
                'nombre_empleado'    => trim($row->first_name . ' ' . $row->last_name),
                'nombre_sucursal'    => $row->nombre_sucursal,
                'nombre_punto_venta' => $row->nombre_punto_venta,
                'nro_punto_venta'    => $row->nro_punto_venta
            ];
        }
        return [
            'sucursal_id'        => null,
            'nombre_empleado'    => 'Desconocido',
            'nombre_sucursal'    => 'No asignada',
            'nombre_punto_venta' => 'No asignado',
            'nro_punto_venta'    => '-'
        ];
    }

    /**
     * Listado de facturas con filtro por fechas.
     * GET/POST a billing/index
     */
    public function index()
    {
        // 1) Fechas de búsqueda
        $inicio = $this->input->post('fecha_inicio') ?? date('Y-m-01');
        $fin    = $this->input->post('fecha_fin')    ?? date('Y-m-d');
        if ($inicio > $fin) {
            $this->session->set_flashdata('error', 'La fecha inicial no puede ser mayor a la final');
            redirect('billing/index');
            return;
        }

        // 2) Datos usuario/sucursal
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];
        if (!$sucursal_id) {
            $this->session->set_flashdata('error', 'No tienes una sucursal asignada.');
            $facturas = [];
        } else {
            // 3) Llamada a la API: listarFacturas
            $resp = $this->call_api([
                'funcion'     => 'listarFacturas',
                'ids'         => $sucursal_id,
                'fechainicio' => $inicio,
                'fechafin'    => $fin
            ]);

            if (isset($resp['error'])) {
                $this->session->set_flashdata('error', 'Error al obtener facturas: ' . $resp['error']);
                $facturas = [];
            } else {
                $facturas = $resp['facturas'] ?? [];

                // 4) Respaldo local: guardar cada factura en siat_factura
               foreach ($facturas as $f) {
    $data = [
        'idPuntoVenta'         => $sucursal_id,
        'fecha'                => $f['fecha'],
        'hora'                 => $f['hora'],
        'nitEmisor'            => $f['nitEmisor'] ?? null,
        'numeroFactura'        => $f['numeroFactura'],
        'cuf'                  => $f['cuf'],
        'nombreRazonSocial'    => $f['nombreRazonSocial'] ?? null,
        'numeroDocumento'      => $f['numeroDocumento'] ?? null,
        'montoTotalSujetoIva'  => $f['montoTotalSujetoIva'] ?? null,
        'descuentoAdicional'   => $f['descuentoAdicional'] ?? null,
        'montoGiftCard'        => $f['montoGiftCard'] ?? null,
        'tipoEmision'          => $f['tipoEmision'] ?? null,
        'estado'               => $f['estado'] ?? null,
        'email'                => $f['email'] ?? null,
        'fecha_sinc'           => date('Y-m-d H:i:s'),
        'sincronizado'         => 1
    ];

    $this->Factura_model->guardar_o_actualizar($data);
}


            }
        }

        // 5) Carga de vistas
        $this->load->view('partial/header');
        $this->load->view('partial/header_facturacion', $datos_usuario);
        $this->load->view('billing/index', [
            'facturas'      => $facturas,
            'fechainicio'   => $inicio,
            'fechafin'      => $fin,
            'datos_usuario' => $datos_usuario
        ]);
        $this->load->view('partial/footer');
    }



    /**
     * Redirige a SIAT para ver la factura vía QR.
     * billing/ver_en_siat/{idfac}
     */
    public function ver_en_siat($idfac = null)
    {
        if (!$idfac) {
            $this->session->set_flashdata('error', 'Factura no identificada');
            redirect('billing/index');
            return;
        }
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];
        if (!$sucursal_id) {
            $this->session->set_flashdata('error', 'No tienes una sucursal asignada.');
            redirect('billing/index');
            return;
        }
        // Llamar lista amplia para buscar CUF si no lo tienes en la vista
        $resp = $this->call_api([
            'funcion'     => 'listarFacturas',
            'ids'         => $sucursal_id,
            'fechainicio' => '1900-01-01',
            'fechafin'    => date('Y-m-d')
        ]);
        $factura = null;
        foreach ($resp['facturas'] ?? [] as $f) {
            if ((string)$f['id'] === (string)$idfac) {
                $factura = $f;
                break;
            }
        }
        if (!$factura || empty($factura['cuf'])) {
            $this->session->set_flashdata('error', 'No se encontró CUF para la factura');
            redirect('billing/index');
            return;
        }
        $query = [
            'nit'    => $factura['nitEmisor'],
            'cuf'    => $factura['cuf'],
            'numero' => $factura['numeroFactura'],
            't'      => 1
        ];
        redirect('https://pilotosiat.impuestos.gob.bo/consulta/QR?' . http_build_query($query));
    }

   public function imprimirTicket($sale_id)
    {
        $this->load->model(['Sale', 'Sale_items', 'Customer', 'Employee']);

        $venta = $this->Sale->get_info_sale($sale_id);
        if (empty($venta)) {
            show_404();
            return;
        }

        $items = $this->Sale_items->get_info_sale($sale_id);
        $cliente = $this->Customer->get_info($venta->customer_id);

        $employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
        $this->db->select('sucursal_id');
        $this->db->from('phppos_sucursal_empleado');
        $this->db->where('employee_id', $employee_id);
        $query = $this->db->get();
        $sucursal_id = $query->num_rows() > 0 ? $query->row()->sucursal_id : 1;

        $resp = $this->call_api(['funcion' => 'listarPos']);
        $sucursal_nombre = '';
        $sucursal_direccion = '';
        if (!empty($resp['pos']['data'])) {
            foreach ($resp['pos']['data'] as $suc) {
                if ((int)$suc['id'] === (int)$sucursal_id) {
                    $sucursal_nombre = $suc['nombre'];
                    $sucursal_direccion = $suc['direccion'];
                    break;
                }
            }
        }

        $payload = [
            'funcion'       => 'obtenerDatosFactura',
            'ids'           => $sucursal_id,
            'sale_id'       => (string)$sale_id,
            'numeroFactura' => $venta->invoice_number
        ];
        $respuesta = $this->call_api($payload);
        if (empty($respuesta['datos'])) {
            show_error('No se recibieron datos de facturación.', 500);
            return;
        }
        $factura = $respuesta['datos'];

        $data = [
            'empresa'  => [
                'nombre'    => $this->config->item('company'),
                'direccion' => $this->config->item('address')
            ],
            'sucursal' => [
                'nombre'    => $sucursal_nombre,
                'direccion' => $sucursal_direccion
            ],
            'venta'    => [
                'fecha'     => date('Y-m-d', strtotime($venta->sale_time)),
                'hora'      => date('H:i:s', strtotime($venta->sale_time)),
                'items'     => array_map(function($it) {
                                    return [
                                        'cantidad'    => $it->quantity,
                                        'descripcion' => $it->description,
                                        'subtotal'    => $it->unit_price * $it->quantity
                                    ];
                                }, $items),
                'subtotal'  => $venta->subtotal,
                'descuento' => $venta->discount,
                'total'     => $venta->total
            ],
            'cliente'  => [
                'nombre'    => $cliente ? $cliente->first_name . ' ' . $cliente->last_name : 'PUBLICO EN GENERAL',
                'nit'       => $cliente ? $cliente->nit : '',
                'direccion' => $cliente ? $cliente->address : ''
            ],
            'factura'  => [
                'numeroFactura' => $factura['numeroFactura'],
                'cuf'           => $factura['cuf'],
                'estado'        => $factura['estado'],
                'qr'            => $factura['qr'] ?? ''
            ]
        ];

        $this->load->view('billing/imprimirticket', $data);
    }
 


    public function anular_factura()
    {
        // Requiere POST
        $idf = $this->input->post('idf');
        $motivo = $this->input->post('motivo');
        if (empty($idf) || empty($motivo)) {
            // Respuesta JSON de error
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode([
                     'success' => false,
                     'message' => 'Faltan parámetros para anular'
                 ]));
            return;
        }
        // Datos usuario/sucursal
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];
        if (!$sucursal_id) {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode([
                     'success' => false,
                     'message' => 'No tienes sucursal asignada'
                 ]));
            return;
        }
        // Llamada a API
        $resp = $this->call_api([
            'funcion' => 'anularFactura',
            'ids'     => $sucursal_id,
            'idf'     => $idf,
            'motivo'  => $motivo
        ]);
        // Determinar éxito según estructura de respuesta
        $ok = false;
        if (isset($resp['success'])) {
            $ok = (bool)$resp['success'];
        } elseif (isset($resp['res']['RespuestaServicioFacturacion']['transaccion'])) {
            $ok = (bool)$resp['res']['RespuestaServicioFacturacion']['transaccion'];
        }
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode([
                 'success' => $ok,
                 'data'    => $resp
             ]));
    }

    /**
     * Revertir factura anulada: billing/revertir_factura/{idfac}
     * Puede invocarse vía GET o POST. Aquí aceptamos GET.
     */
    public function revertir_factura($idfac = null)
    {
        if (!$idfac) {
            $this->session->set_flashdata('error', 'Factura no especificada');
            redirect('billing/index');
            return;
        }
        // Datos usuario
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];
        if (!$sucursal_id) {
            $this->session->set_flashdata('error', 'No tienes sucursal asignada');
            redirect('billing/index');
            return;
        }
        // Llamada API
        $resp = $this->call_api([
            'funcion' => 'revertirFactura',
            'ids'     => $sucursal_id,
            'idf'     => $idfac
        ]);
        $ok = false;
        if (isset($resp['res']['RespuestaServicioFacturacion']['transaccion'])) {
            $ok = (bool)$resp['res']['RespuestaServicioFacturacion']['transaccion'];
        }
        if ($ok) {
            $this->session->set_flashdata('success', 'Factura revertida correctamente');
        } else {
            $msg = $resp['error'] ?? 'Error al revertir factura';
            $this->session->set_flashdata('error', $msg);
        }
        redirect('billing/index');
    }

    /**
     * Reenviar email de factura: billing/enviar_email
     * Invocado vía AJAX POST: idf, email, rzs, nit, cuf
     */
    public function enviar_email()
{
    $idf   = $this->input->post('idf');
    $email = $this->input->post('email');
    $rzs   = $this->input->post('rzs');
    $nit   = $this->input->post('nit');
    $cuf   = $this->input->post('cuf');

    if (empty($idf) || empty($email) || empty($rzs) || empty($nit) || empty($cuf)) {
        $this->session->set_flashdata('error', 'Faltan parámetros para reenviar el correo.');
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['success' => false]));
        return;
    }
    $datos_usuario = $this->_datos_usuario();
    $sucursal_id   = $datos_usuario['sucursal_id'];
    if (!$sucursal_id) {
        $this->session->set_flashdata('error', 'No tienes sucursal asignada.');
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['success' => false]));
        return;
    }
    $resp = $this->call_api([
        'funcion' => 'enviarMailFactura',
        'ids'     => $sucursal_id,
        'mail'    => $email,
        'rzs'     => $rzs,
        'nit'     => $nit,
        'cuf'     => $cuf
    ]);
    $ok = false;
    if (isset($resp['encontrado'])) {
        $ok = (bool)$resp['encontrado'];
    } elseif (isset($resp['correo'])) {
        $ok = (bool)$resp['correo'];
    }
    if ($ok) {
        $this->session->set_flashdata('success', 'Correo reenviado correctamente a '.$email);
    } else {
        $msg = $resp['message'] ?? $resp['error'] ?? 'No se pudo reenviar el correo';
        $this->session->set_flashdata('error', $msg);
    }
    // Devolver JSON con éxito/fallo; el mensaje se mostrará tras recarga
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode(['success' => $ok]));
}


    /**
     * Ver XML de factura: billing/ver_xml/{cuf}
     * Si tu flujo actual usa base_url("Siat/temp/factura-$cuf.xml"), puedes mantenerlo o descargar desde API.
     */
    public function ver_xml($cuf = null)
    {
        if (!$cuf) {
            $this->session->set_flashdata('error', 'CUP de factura no especificado');
            redirect('billing/index');
            return;
        }
        // Ejemplo: si guardas XML localmente en carpeta Siat/temp, rediriges:
        redirect(base_url("Siat/temp/factura-$cuf.xml"));
    }



    // FACTURAR
    public function facturar($sale_id = null)
    {

        $datos_usuario = $this->_datos_usuario();

        $this->load->model(['Item', 'Sale']);

        $productos = $this->Item->get_all();
        $razon_social = '';
        $nit = '';
        $email = '';
        $facturas = [];
        $subtotal = 0.00;
        $descuento_total = 0.00;
        $total = 0.00;


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
                    'codigo'        => $p->item_id,
                    'cantidad'      => (float)$p->quantity_purchased,
                    'descripcion'   => $p->item_nombre,
                    'preciounitario' => (float)$p->item_unit_price,
                    'descuento'     => (float)$p->discount_percent,
                    'subtotal'      => (float)$p->item_subtotal,
                ];
            }
        }

        $this->load->view('partial/header');
        $this->load->view('partial/header_facturacion', $datos_usuario);
        // 6) Cargar la vista 'billing/facturar' con los datos de la venta
        $this->load->view('billing/facturar', [
            'razon_social' => $razon_social,
            'nit'          => $nit,
            'email'        => $email,
            'facturas'     => $facturas,
            'subtotal'     => $subtotal,
            'descuento'    => $descuento_total,
            'total'        => $total,
            'productos'    => $productos
        ]);
        $this->load->view('partial/footer');
    }


    public function procesar_factura()
    {
        $maestro = $this->input->post('maestro');
        $detalle = $this->input->post('detalle');

        $payload = [
            'funcion' => 'procesarFactura',
            'maestro' => $maestro,
            'detalle' => $detalle
        ];

        $resp = $this->call_api($payload);

        if (!empty($resp['ok'])) {
            $this->session->set_flashdata('success', 'Factura emitida correctamente');
        } else {
            $this->session->set_flashdata('error', $resp['error'] ?? 'Error al emitir factura');
        }

        redirect('billing/index');
    }
    ////

    // CODIGOS
    public function codigos()
    {
        // 1) Obtener datos del usuario (incluye sucursal_id)
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];

        // 2) Primero, traer los CUFDs locales de tu modelo
        $cufdsLocal = $this->Cufd_model->obtener_todos();
        if (empty($cufdsLocal)) {
            // Si no hay registros locales, llamar a la API para listar
            $resp = $this->call_api([
                'funcion' => 'listarCodigos',
                'ids'     => $sucursal_id
            ]);
            $cufdsLocal = $resp['cufds']['data'] ?? [];
        }

        // 3) Luego, siempre llamar a la API para obtener los CUIS
        $resp2 = $this->call_api([
            'funcion' => 'listarCodigos',
            'ids'     => $sucursal_id
        ]);
        $cuis = $resp2['cuiss']['data'] ?? [];

        $this->load->view('partial/header');
        // 4) Cargar el header de facturación con datos del usuario
        $this->load->view('partial/header_facturacion', $datos_usuario);

        // 5) Cargar la vista específica “billing/codigos” con los datos necesarios
        $this->load->view('billing/codigos', [
            'cufds' => $cufdsLocal,
            'cuis'  => $cuis
        ]);

        // 6) Cargar el footer
        $this->load->view('partial/footer');
    }

    public function sincronizar_cufd()
    {

        $this->call_api(['funcion' => 'sincronizarCufd', 'ids' => '1']);
        $resp = $this->call_api(['funcion' => 'listarCodigos', 'ids' => '1']);
        $cufdsApi = $resp['cufds']['data'] ?? [];

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

        $this->session->set_flashdata('success', 'CUFD sincronizado correctamente.');
        redirect('billing/codigos');
    }

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

    /////

    public function configuracion()
    {

        $datos_usuario = $this->_datos_usuario();

        $respuesta = $this->call_api([
            'funcion' => 'configuracionSiat'
        ]);

        $config = $respuesta['configuracion'] ?? [];

        // 3) Pasar a la vista
        $data = [
            'config'       => $config,
            'company_name' => $config['razonSocial'] ?? ''
        ];

        // 4) Cargar vistas
        $this->load->view('partial/header', $datos_usuario);
        $this->load->view('partial/header_facturacion', $datos_usuario);
        $this->load->view('billing/configuracion', $data);
        $this->load->view('partial/footer');
    }


    public function editarConfiguracion()
    {

        $respuesta = $this->call_api([
            'funcion' => 'configuracionSiat'
        ]);

        $config = $respuesta['configuracion'] ?? [];

        // 3) Enviar a la vista de edición


        $this->load->view('billing/editarConfiguracion', [
            'config' => $config
        ]);
    }


    public function guardarConfiguracion()
    {
        $post = $this->input->post();
        $params = [
            'funcion'          => 'updConfiguracion',
            'nomsistema'       => $post['nomsistema']       ?? '',
            'codsistema'       => $post['codsistema']       ?? '',
            'rzssistema'       => $post['rzssistema']       ?? '',
            'nitsistema'       => $post['nitsistema']       ?? '',
            'modsistema'       => $post['modsistema']       ?? '',
            'cafcsistema'      => $post['cafcsistema']      ?? '',
            'monsistema'       => $post['monsistema']       ?? '',
            'docsectorsistema' => $post['docsectorsistema'] ?? '',
            'facsistema'       => $post['facsistema']       ?? '',
            'toksistema'       => $post['toksistema']       ?? '',
            'metsistema'       => $post['metsistema']       ?? '',
            'ciusistema'       => $post['ciusistema']       ?? '',
            'telsistema'       => $post['telsistema']       ?? '',
            'impsistema'       => $post['impsistema']       ?? '',
            'ambsistema'       => $post['ambsistema']       ?? '',
            'inicafcsistema'   => $post['inicafcsistema']   ?? '',
            'fincafcsistema'   => $post['fincafcsistema']   ?? '',
            'pubsistema'       => $post['pubsistema']       ?? '',
            'privsistema'      => $post['privsistema']      ?? '',
            'emailsistema'     => $post['emailsistema']     ?? '',
            'pwdemailsistema'  => $post['pwdemailsistema']  ?? '',
            'smtpemailsistema' => $post['smtpemailsistema'] ?? ''
        ];

        $resp = $this->call_api($params);
        if (!empty($resp['success']) && $resp['success'] === true) {
            $this->session->set_flashdata('success', 'Configuración guardada correctamente.');
        } else {
            $this->session->set_flashdata('error', $resp['error'] ?? 'No se pudo guardar la configuración.');
        }
        redirect('billing/configuracion');
    }

    ////

    // SUCURSALES
    public function sucursales()
    {
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];

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

        $respPdv = $this->call_api(['funcion' => 'listarPos']);
        $posApi  = $respPdv['pos']['data'] ?? [];  
        foreach ($posApi as $pv) {

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

            ]);
        }

        $sucursales  = $this->Sucursal_model->obtener_todas();
        $puntosVenta = $this->PuntoVenta_model->obtener_todos();

        $this->load->view('partial/header');
        $this->load->view('partial/header_facturacion', $datos_usuario);

        $this->load->view('billing/sucursales', [
            'sucursales'  => $sucursales,
            'puntosVenta' => $puntosVenta
        ]);
        $this->load->view('partial/footer');
    }


    public function sincronizar_sucursales()
    {
        $this->call_api(['funcion' => 'listarSucursales']);
        redirect('billing/sucursales');
    }

    public function sincronizar_puntos()
    {
        $this->load->model('PuntoVenta_model');


        $this->call_api(['funcion' => 'sincronizarPos', 'nroSucursal' => 0]);


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

        $resp = $this->call_api($payload);


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
            'funcion'         => 'newPos',
            'nroSucursal'     => $this->input->post('nroSucursal'),
            'nroPuntoVenta'   => $this->input->post('nroPuntoVenta'),
            'nombrePuntoVenta' => $this->input->post('nombre'),
            'tipoPuntoVenta'  => $this->input->post('tipo_punto_venta'),
            'tipoEmision'     => $this->input->post('tipo_emision'),
        ];

        $resp = $this->call_api($payload);

        if (!empty($resp['ok'])) {

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
        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];
        $this->load->view('partial/header');
        $this->load->view('partial/header_facturacion', $datos_usuario);

        $this->load->view('billing/sincronizacion');

        $this->load->view('partial/footer');
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

        $datos_usuario = $this->_datos_usuario();
        $sucursal_id   = $datos_usuario['sucursal_id'];


        $resp = $this->call_api([
            'funcion' => 'listarEventos',
            'ids'     => $sucursal_id
        ]);

        $this->load->view('partial/header');
        $this->load->view('partial/header_facturacion', $datos_usuario);

        $this->load->view('billing/eventos', [
            'eventos' => $resp['eventos']['data'] ?? []
        ]);

        $this->load->view('partial/footer');
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



    public function sincroizacion()
    {

        $this->load->view('billing/sincronizarGeneral');
    }

    // En application/controllers/Billing.php

    /**
     * Buscar cliente por NIT/CI usando customers.account_number
     */
    public function buscar_cliente_por_nit()
    {
        $nit = $this->input->get('nit');
        if (!$nit) {
            echo json_encode(['success' => false]);
            return;
        }

        $cliente = $this->db
            ->select("
            c.account_number        AS nit,
            p.full_name             AS razon_social,
            p.email
        ")
            ->from('phppos_customers AS c')
            ->join('phppos_people    AS p', 'p.person_id = c.person_id')
            ->where('c.account_number', $nit)
            ->where('c.deleted', 0)
            ->get()
            ->row();

        if ($cliente) {
            echo json_encode([
                'success' => true,
                'data'    => [
                    'nit'          => $cliente->nit,
                    'razon_social' => $cliente->razon_social,
                    'email'        => $cliente->email
                ]
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    /**
     * Buscar cliente por Razón Social usando people.full_name
     */
    public function buscar_cliente_por_nombre()
    {
        $nombre = $this->input->get('nombre');
        if (!$nombre) {
            echo json_encode(['success' => false]);
            return;
        }

        $cliente = $this->db
            ->select("
            c.account_number        AS nit,
            p.full_name             AS razon_social,
            p.email
        ")
            ->from('phppos_customers AS c')
            ->join('phppos_people    AS p', 'p.person_id = c.person_id')
            ->like('p.full_name', $nombre)
            ->where('c.deleted', 0)
            ->limit(1)
            ->get()
            ->row();

        if ($cliente) {
            echo json_encode([
                'success' => true,
                'data'    => [
                    'nit'          => $cliente->nit,
                    'razon_social' => $cliente->razon_social,
                    'email'        => $cliente->email
                ]
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    //Funcion para ventas sin factura 
    public function sales_without_invoice()
    {
        // Default date range: first day of current month 00:00:00 to today 23:59:59
        $default_start = date('Y-m-01') . ' 00:00:00';
        $default_end   = date('Y-m-d') . ' 23:59:59';

        // Initialize sales array empty
        $sales = [];

        // Prepare start_date and end_date for the view (always use defaults if GET not present)
        $start_date = $this->input->get('start_date')
            ? $this->input->get('start_date') . ' 00:00:00'
            : $default_start;
        $end_date = $this->input->get('end_date')
            ? $this->input->get('end_date') . ' 23:59:59'
            : $default_end;

        // Only fetch data if the user has submitted the date filters
        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            $this->load->model('Billing_model');
            $sales = $this->Billing_model->get_sales_without_invoice($start_date, $end_date);
        }

        // Pass data to the view
        $this->load->view('billing/sales_without_invoice', [
            'sales'      => $sales,
            'start_date' => $start_date,
            'end_date'   => $end_date
        ]);
    }

    public function sales_with_invoice()
    {
        $default_start = date('Y-m-01') . ' 00:00:00';
        $default_end   = date('Y-m-d') . ' 23:59:59';

        $sales = [];

        $start_date = $this->input->get('start_date')
            ? $this->input->get('start_date') . ' 00:00:00'
            : $default_start;
        $end_date = $this->input->get('end_date')
            ? $this->input->get('end_date') . ' 23:59:59'
            : $default_end;

        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            $this->load->model('Billing_model');
            $sales = $this->Billing_model->get_sales_with_invoice($start_date, $end_date);
        }

        $this->load->view('billing/sales_with_invoice', [
            'sales'      => $sales,
            'start_date' => $start_date,
            'end_date'   => $end_date
        ]);
    }
}
