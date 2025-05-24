<?php
require_once("Report.php");

class Sales_without_invoice extends Report
{
    protected $settings = [
        'permission_action' => 'view_sales_without_invoice', // <- Este permiso debes darlo al usuario
        'display' => 'tabular',
        'subtitle' => '',
        'columns' => [],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $this->db->from('sales');
        $this->db->where('is_invoiced', 0); // Ajusta al campo que uses para saber si fue facturado
        $this->db->join('people', 'sales.customer_id = people.person_id', 'left');
        $this->db->select('sales.sale_id, sales.sale_time, people.first_name, people.last_name, sales.total');

        return $this->db->get()->result_array();
    }

    public function getSummaryData()
    {
        $this->db->select('SUM(total) as total');
        $this->db->from('sales');
        $this->db->where('is_invoiced', 0);

        return $this->db->get()->row_array();
    }

    public function getInputData()
    {
        return [
            'input_params' => [
                [
                    'view' => 'date_range',
                    'with_time' => true,
                ],
            ]
        ];
    }

    // Aquí procesamos la lógica del reporte
    public function getOutputData()
    {
        $this->load->model('Sale');

        $sales = $this->Sale->get_sales_without_invoice(
            $this->params['start_date'],
            $this->params['end_date']
        );

        $summary_data = [];

        foreach ($sales as $sale)
        {
            $summary_data[] = [
                'sale_id' => $sale['sale_id'],
                'customer' => $sale['customer_name'],
                'sale_time' => $sale['sale_time'],
                'total' => to_currency($sale['total'])
            ];
        }

        return [
            'summary' => $summary_data,
            'title' => lang('reports_sales_without_invoice')
        ];
    }
}
