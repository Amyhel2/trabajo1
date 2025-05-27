<?php
require_once(APPPATH . "traits/saleTrait.php");
require_once(APPPATH . "models/cart/PHPPOSCartSale.php");


class Billing_model extends MY_Model
{
    use saleTrait;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inventory');
	}
    protected $table = 'phppos_facturas';

    
    /** Inserta un nuevo registro y devuelve su ID local */
    public function insert(array $data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /** Busca un registro local por api_id */
    public function get_by_api_id($api_id)
    {
        return $this->db
            ->where('api_id', $api_id)
            ->get($this->table)
            ->row_array();
    }

    /** Actualiza el estado de la factura local */
    public function update_estado($id, $estado)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, ['estado' => $estado]);
    }

    
    public function mark_pdf_generated($id)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, ['pdf_generado' => 1]);
    }

    public function obtener_todos() {
    return $this->db->get('puntos_venta_siat')->result();
    
}

    public function get_sales_without_invoice($start_date, $end_date)
    {
        $this->db->select('sale_id, sale_time, customer_id, total, is_invoiced');
        $this->db->from('phppos_sales');
        $this->db->where('is_invoiced', 0);
        $this->db->where('sale_time >=', $start_date);
        $this->db->where('sale_time <=', $end_date);
        $this->db->order_by('sale_time', 'DESC');
        return $this->db->get()->result_array();
    }

}
