<?php
require_once(APPPATH . "traits/saleTrait.php");
require_once(APPPATH . "models/cart/PHPPOSCartSale.php");

class Billing extends MY_Model
{
	use saleTrait;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Appconfig');
	}

	
	public function get_config() {
        $keys = [
            'company',
            'company_nit',
            'company_email',
            'billing_cuis',
            'billing_cufd',
            'billing_token',
            'billing_modalidad',
            'billing_ambiente'

        ];
        $config = [];
        foreach ($keys as $key) {
            $config[$key] = $this->Appconfig->get($key);
        }
        return $config;
    }

   
    public function save_config(array $data) {
        foreach ($data as $key => $value) {
            $this->Appconfig->save($key, $value);
        }
    }
}
