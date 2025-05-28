<?php
require_once(APPPATH . "traits/saleTrait.php");
require_once(APPPATH . "models/cart/PHPPOSCartSale.php");


class Billing_model extends MY_Model
{
    use saleTrait;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Appconfig');
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

    public function obtener_todos()
    {
        return $this->db->get('puntos_venta_siat')->result();
    }

    public function get_sales_without_invoice($start_date, $end_date)
    {
        $this->db->select('phppos_sales.sale_id, phppos_sales.sale_time, phppos_sales.total, phppos_sales.is_invoiced, phppos_people.full_name, phppos_customers.account_number');
        $this->db->from('phppos_sales');
        $this->db->join('phppos_people', 'phppos_sales.customer_id = phppos_people.person_id', 'left');
        $this->db->join('phppos_customers', 'phppos_people.person_id = phppos_customers.person_id', 'left');
        $this->db->where('phppos_sales.is_invoiced', 0);
        $this->db->where('phppos_sales.sale_time >=', $start_date);
        $this->db->where('phppos_sales.sale_time <=', $end_date);
        $this->db->order_by('phppos_sales.sale_time', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_sales_with_invoice($start_date, $end_date)
    {
        $this->db->select('phppos_sales.sale_id, phppos_sales.sale_time, phppos_sales.total, phppos_sales.is_invoiced, phppos_people.full_name, phppos_customers.account_number');
        $this->db->from('phppos_sales');
        $this->db->join('phppos_people', 'phppos_sales.customer_id = phppos_people.person_id', 'left');
        $this->db->join('phppos_customers', 'phppos_people.person_id = phppos_customers.person_id', 'left');
        $this->db->where('phppos_sales.is_invoiced', 1);
        $this->db->where('phppos_sales.sale_time >=', $start_date);
        $this->db->where('phppos_sales.sale_time <=', $end_date);
        $this->db->order_by('phppos_sales.sale_time', 'DESC');
        return $this->db->get()->result_array();
    }

  
}
