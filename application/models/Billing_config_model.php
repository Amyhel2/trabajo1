<?php

require_once(APPPATH . "traits/saleTrait.php");
require_once(APPPATH . "models/cart/PHPPOSCartSale.php");
class Billing_config_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Carga el modelo Appconfig de phpPOS
        $this->load->model('Appconfig');
    }

    /**
     * Obtiene todos los valores de configuración de facturación
     * @return array
     */
    public function get_all() {
        return [
            'nombre_sistema'          => $this->Appconfig->get('company'),
            'codigo_sistema'          => $this->Appconfig->get('billing_cuis'),
            'nit'                     => $this->Appconfig->get('company_nit'),
            'razon_social'            => $this->Appconfig->get('company'),
            'modalidad'               => $this->Appconfig->get('billing_modalidad'),
            'ambiente'                => $this->Appconfig->get('billing_ambiente'),
            'tipo_factura'            => $this->Appconfig->get('billing_tipo_factura'),
            'tipo_documento_sector'   => $this->Appconfig->get('billing_tipo_documento_sector'),
            'tipo_moneda'             => $this->Appconfig->get('billing_tipo_moneda'),
            'token'                   => $this->Appconfig->get('billing_token'),
            'ciudad'                  => $this->Appconfig->get('billing_ciudad'),
            'telefono'                => $this->Appconfig->get('billing_telefono'),
            'tipo_impresion'          => $this->Appconfig->get('billing_tipo_impresion'),
            'cafc'                    => $this->Appconfig->get('billing_cafc'),
            'inicio_cafc'             => $this->Appconfig->get('billing_inicio_cafc'),
            'fin_cafc'                => $this->Appconfig->get('billing_fin_cafc'),
            'email_envio'             => $this->Appconfig->get('billing_email_envio'),
            'pass_email'              => $this->Appconfig->get('billing_pass_email'),
            'smtp_email'              => $this->Appconfig->get('billing_smtp_email'),
            'llave_publica'           => $this->Appconfig->get('billing_llave_publica'),
            'llave_privada'           => $this->Appconfig->get('billing_llave_privada'),
            'metodo_pago'             => $this->Appconfig->get('billing_metodo_pago')
        ];
    }

    /**
     * Guarda o actualiza todos los valores de configuración de facturación
     * @param array $data
     */
    public function save_all(array $data) {
        $this->Appconfig->save('company',                  $data['nombre_sistema']);
        $this->Appconfig->save('billing_cuis',             $data['codigo_sistema']);
        $this->Appconfig->save('company_nit',              $data['nit']);
        $this->Appconfig->save('company',                  $data['razon_social']);
        $this->Appconfig->save('billing_modalidad',        $data['modalidad']);
        $this->Appconfig->save('billing_ambiente',         $data['ambiente']);
        $this->Appconfig->save('billing_tipo_factura',     $data['tipo_factura']);
        $this->Appconfig->save('billing_tipo_documento_sector', $data['tipo_documento_sector']);
        $this->Appconfig->save('billing_tipo_moneda',      $data['tipo_moneda']);
        $this->Appconfig->save('billing_token',            $data['token']);
        $this->Appconfig->save('billing_ciudad',           $data['ciudad']);
        $this->Appconfig->save('billing_telefono',         $data['telefono']);
        $this->Appconfig->save('billing_tipo_impresion',   $data['tipo_impresion']);
        $this->Appconfig->save('billing_cafc',             $data['cafc']);
        $this->Appconfig->save('billing_inicio_cafc',      $data['inicio_cafc']);
        $this->Appconfig->save('billing_fin_cafc',         $data['fin_cafc']);
        $this->Appconfig->save('billing_email_envio',      $data['email_envio']);
        $this->Appconfig->save('billing_pass_email',       $data['pass_email']);
        $this->Appconfig->save('billing_smtp_email',       $data['smtp_email']);
        $this->Appconfig->save('billing_llave_publica',    $data['llave_publica']);
        $this->Appconfig->save('billing_llave_privada',    $data['llave_privada']);
        $this->Appconfig->save('billing_metodo_pago',      $data['metodo_pago']);
    }
}


 
 