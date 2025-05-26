<?php
require_once("Report.php");

class Sales_without_invoice extends Report
{
    function __construct()
    {
        parent::__construct();
    }

    // No necesita filtros para ejecutarse
    public function getInputData()
    {
        return array(
            'report_type' => 'simple',
            'input_params' => array()
        );
    }

    public function getDataColumns()
    {
        return array(
            'summary' => array(
                array('data' => 'ID Venta', 'align' => 'left'),
                array('data' => 'Fecha', 'align' => 'left'),
                array('data' => 'Cliente', 'align' => 'left'),
                array('data' => 'Total', 'align' => 'right'),
            ),
            'details' => array() // No detalles por ahora
        );
    }

    public function getData()
    {
        $this->db->select('sales.sale_id, sales.sale_time, CONCAT(customers.first_name, " ", customers.last_name) AS customer_name, sales.total');
        $this->db->from('sales');
        $this->db->join('customers', 'customers.person_id = sales.customer_id', 'left');
        $this->db->where('sales.invoice_number IS NULL');
        $this->db->where('sales.deleted', 0); // Solo ventas válidas

        $result = $this->db->get()->result_array();

        $data = array();
        foreach ($result as $row)
        {
            $data[] = array(
                'sale_id' => $row['sale_id'],
                'sale_time' => $row['sale_time'],
                'customer' => $row['customer_name'],
                'total' => $row['total']
            );
        }

        return $data;
    }

    public function getSummaryData()
    {
        $this->db->select('SUM(total) as total');
        $this->db->from('sales');
        $this->db->where('invoice_number IS NULL');
        $this->db->where('deleted', 0);

        $row = $this->db->get()->row_array();
        return array('total' => $row['total']);
    }

    public function getOutputData()
    {
        $report_data = $this->getData();
        $tabular_data = array();

        foreach ($report_data as $row)
        {
            $tabular_data[] = array(
                $row['sale_id'],
                date(get_date_format(), strtotime($row['sale_time'])),
                $row['customer'],
                to_currency($row['total'])
            );
        }

        $data = array(
            'view' => 'tabular',
            'title' => 'Ventas sin Factura',
            'headers' => $this->getDataColumns(),
            'data' => $tabular_data,
            'summary_data' => $this->getSummaryData(),
            'export_excel' => false
        );

        return $this->load->view("reports/tabular", $data, true);
    }
}
