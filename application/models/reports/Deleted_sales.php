<?php
require_once("Report.php");

class Custom_sales extends Report
{
    public function getInputData()
    {
        return array(
            'input_data' => array(
                array('view' => 'date_range', 'with_time' => TRUE),
                array('view' => 'customers'),
                array('view' => 'employees'),
                array('view' => 'dropdown', 'dropdown_label' => lang('reports_sale_type'), 'dropdown_name' => 'sale_type',
                    'dropdown_options' => array(
                        'all' => lang('reports_all'),
                        'sales' => lang('reports_sales'),
                        'returns' => lang('reports_returns')
                    ),
                    'required' => false
                )
            )
        );
    }

    public function getDataColumns()
    {
        return array(
            'summary' => array(
                array('data' => lang('common_sale_id'), 'align' => 'left'),
                array('data' => lang('common_date'), 'align' => 'left'),
                array('data' => lang('common_employee'), 'align' => 'left'),
                array('data' => lang('common_customer'), 'align' => 'left'),
                array('data' => lang('common_total'), 'align' => 'right')
            ),
            'details' => array()
        );
    }

    public function getData()
    {
        $this->db->select('sales.sale_id, sales.sale_time, CONCAT(employee.first_name, " ", employee.last_name) as employee_name, CONCAT(customer.first_name, " ", customer.last_name) as customer_name, sales.total');
        $this->db->from('sales');
        $this->db->join('people as employee', 'sales.employee_id = employee.person_id');
        $this->db->join('people as customer', 'sales.customer_id = customer.person_id', 'left');

        $this->db->where('sales.deleted', 0);

        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        if ($start_date && $end_date)
        {
            $this->db->where('sales.sale_time BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        }

        if ($this->params['customer_id'] != -1)
        {
            $this->db->where('sales.customer_id', $this->params['customer_id']);
        }

        if ($this->params['employee_id'] != -1)
        {
            $this->db->where('sales.employee_id', $this->params['employee_id']);
        }

        if ($this->params['sale_type'] == 'sales')
        {
            $this->db->where('sales.total >=', 0);
        }
        elseif ($this->params['sale_type'] == 'returns')
        {
            $this->db->where('sales.total <', 0);
        }

        if (!$this->params['export_excel'])
        {
            $this->db->limit($this->report_limit);
            $this->db->offset($this->params['offset']);
        }

        $data = array();

        foreach ($this->db->get()->result_array() as $row)
        {
            $data[] = $row;
        }

        return $data;
    }

    public function getTotalRows()
    {
        $this->db->from('sales');
        $this->db->where('deleted', 0);

        if ($this->params['customer_id'] != -1)
        {
            $this->db->where('customer_id', $this->params['customer_id']);
        }

        if ($this->params['employee_id'] != -1)
        {
            $this->db->where('employee_id', $this->params['employee_id']);
        }

        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        if ($start_date && $end_date)
        {
            $this->db->where('sale_time BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        }

        return $this->db->count_all_results();
    }

    public function getSummaryData()
    {
        $this->db->select('SUM(total) as total');
        $this->db->from('sales');
        $this->db->where('deleted', 0);

        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        if ($start_date && $end_date)
        {
            $this->db->where('sale_time BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        }

        if ($this->params['customer_id'] != -1)
        {
            $this->db->where('customer_id', $this->params['customer_id']);
        }

        if ($this->params['employee_id'] != -1)
        {
            $this->db->where('employee_id', $this->params['employee_id']);
        }

        if ($this->params['sale_type'] == 'sales')
        {
            $this->db->where('total >=', 0);
        }
        elseif ($this->params['sale_type'] == 'returns')
        {
            $this->db->where('total <', 0);
        }

        $row = $this->db->get()->row_array();
        return array('total' => $row['total']);
    }

    public function getOutputData()
    {
        $tabular_data = array();

        foreach ($this->getData() as $row)
        {
            $tabular_data[] = array(
                $row['sale_id'],
                date(get_date_format().' '.get_time_format(), strtotime($row['sale_time'])),
                $row['employee_name'],
                $row['customer_name'],
                to_currency($row['total'])
            );
        }

        $data = array(
            'view' => 'tabular',
            'title' => 'Reporte Personalizado',
            'headers' => $this->getDataColumns(),
            'data' => $tabular_data,
            'summary_data' => $this->getSummaryData(),
            'export_excel' => $this->params['export_excel']
        );

        return $this->load->view("reports/tabular", $data, true);
    }
}
