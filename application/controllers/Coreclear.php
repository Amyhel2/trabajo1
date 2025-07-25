<?php

use BlockChyp\BlockChyp;

require_once("Secure_area.php");
require_once(APPPATH . "traits/creditcardProcessingTrait.php");

class Coreclear extends Secure_area {
    use creditcardProcessingTrait;
    
    function __construct() {
        parent::__construct('sales');
        $this->lang->load('module');
        $this->lang->load('sales');
        $this->load->model('Sale');
    }
    
    function index() {
        $credit_card_processor = $this->_get_cc_processor();
        
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            $this->load->view('coreclear/coreclear_info');
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            $this->load->view('coreclear/coreclear_transaction_history_not_supported');
            return;
        }
        
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $params = [
            'startDate'  => date('c', strtotime($start_date ? $start_date : date('Y-m-d 00:00:00', strtotime('-1 days')))),
            'endDate'    => date('c', strtotime($end_date ? $end_date . ' 23:59:59' : date('Y-m-d 23:59:59', strtotime('+1 days')))),
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        $all_transactions = array();
        
        $transactions = $credit_card_processor->get_transaction_history($params);
        // echo '<pre>';
        // print_r($transactions);exit;
        $all_transactions = array_merge($all_transactions, $transactions['transactions']);
        $total_transactions = $transactions['totalResultCount'];
        
        $total_pages = ceil($total_transactions / $params['maxResults']);
        for ($startIndex = $params['maxResults']; $startIndex < $params['maxResults'] * $total_pages; $startIndex += $params['maxResults']) {
            $params['startIndex'] = $startIndex;
            $transactions = $credit_card_processor->get_transaction_history($params);
            $all_transactions = array_merge($all_transactions, $transactions['transactions']);
            
        }
        
        if (!$this->input->get('transaction_type')) {
            $transaction_types = array('charge', 'refund', 'reverse', 'capture');
        }
        else {
            $transaction_types = $this->input->get('transaction_type');
        }
        
        $all_transactions = array_filter($all_transactions, function ($transaction) use ($transaction_types) {
            if (in_array($transaction['transactionType'], $transaction_types)) {
                if ($this->input->get('show_declines')) {
                    return TRUE;
                }
                else {
                    //Only approved transactions
                    return $transaction['approved'];
                }
            }
            
            return FALSE;
        });
        
        $all_transaction_ids = array_column($all_transactions, 'transactionId');
        
        $total_amount = 0;
        foreach ($all_transactions as $transaction) {
            if ($transaction['transactionType'] == 'refund' || $transaction['transactionType'] == 'void' || $transaction['transactionType'] == 'reverse') {
                //need to call make_currency_no_money because authorizedAmount has a comma in it and won't add correctly
                $total_amount -= $transaction['approved'] ? make_currency_no_money($transaction['authorizedAmount']) : 0;
            }
            else {
                //need to call make_currency_no_money because authorizedAmount has a comma in it and won't add correctly
                $total_amount += $transaction['approved'] ? make_currency_no_money($transaction['authorizedAmount']) : 0;
            }
        }
        
        //This will pre-warm cache so we don't make a ton of database queries
        $this->Sale->get_sale_id_from_payment_ref_no($all_transaction_ids);
        $data = array(
            'start_date'        => date(get_date_format(), strtotime($start_date ? $start_date : '-1 days')),
            'end_date'          => date(get_date_format(), strtotime($end_date ? $end_date : '+1 day')),
            'transaction_types' => $transaction_types,
            'transactions'      => $all_transactions,
            'total_amount'      => to_currency($total_amount),
            'length_dropdown'   => range($params['maxResults'], $total_pages * $params['maxResults'], 10)
        );
        
        
        $this->load->view('coreclear/blockchyp_transaction_history', $data);
    }
    
    function batches($is_portal = 0) {
        $credit_card_processor = $this->_get_cc_processor();
        
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            if ($is_portal) {
                echo json_encode(['success' => false]);
            }
            else {
                $this->load->view('coreclear/coreclear_info');
            }
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            if ($is_portal) {
                echo json_encode(['success' => false]);
            }
            else {
                $this->load->view('coreclear/coreclear_transaction_history_not_supported');
            }
            return;
        }
        
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $params = [
            'startDate'  => date('c', strtotime($start_date ? $start_date : '-10 days')),
            'endDate'    => date('c', strtotime($end_date ? $end_date . ' 23:59:59' : '+1 day')),
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        $all_batches = array();
        
        $batches = $credit_card_processor->get_batch_history($params);
        $all_batches = array_merge($all_batches, $batches['batches']);
        $total_batches = $batches['totalResultCount'];
        
        $total_pages = ceil($total_batches / $params['maxResults']);
        for ($startIndex = $params['maxResults']; $startIndex < $params['maxResults'] * $total_pages; $startIndex += $params['maxResults']) {
            $params['startIndex'] = $startIndex;
            $batches = $credit_card_processor->get_batch_history($params);
            $all_batches = array_merge($all_batches, $batches['batches']);
            
        }
        
        if ($is_portal) {
            foreach ($all_batches as $key => $batch) {
                $all_batches[$key]['transactions'] = array();
            }
        }
        
        $data = array(
            'start_date'      => date(get_date_format(), strtotime($start_date ? $start_date : '-10 days')),
            'end_date'        => date(get_date_format(), strtotime($end_date ? $end_date : '+1 day')),
            'batches'         => $all_batches,
            'length_dropdown' => range($params['maxResults'], $total_pages * $params['maxResults'], 10)
        );
        
        if ($is_portal) {
            echo json_encode($data);
        }
        else {
            $this->load->view('coreclear/blockchyp_batch_history', $data);
        }
    }
    
    function batch_details($is_portal = 0) {
        $credit_card_processor = $this->_get_cc_processor();
        
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            if ($is_portal) {
                echo json_encode(['success' => false]);
            }
            else {
                $this->load->view('coreclear/coreclear_info');
            }
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            if ($is_portal) {
                echo json_encode(['success' => false]);
            }
            else {
                $this->load->view('coreclear/coreclear_transaction_history_not_supported');
            }
            return;
        }
        
        $batch_id = $is_portal ? $this->input->get('batch_id') : $this->input->post('batch_id');
        
        echo json_encode($credit_card_processor->get_batch_details(array('batchId' => $batch_id)));
    }
    
    function get_transactions_for_batch($is_portal = 0) {
        $credit_card_processor = $this->_get_cc_processor();
        
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            if ($is_portal) {
                echo json_encode(['success' => false]);
            }
            else {
                $this->load->view('coreclear/coreclear_info');
            }
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            if ($is_portal) {
                echo json_encode(['success' => false]);
            }
            else {
                $this->load->view('coreclear/coreclear_transaction_history_not_supported');
            }
            return;
        }
        
        $batch_id = $is_portal ? $this->input->get('batch_id') : $this->input->post('batch_id');
        
        $params = [
            'batchId'    => $batch_id,
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        $headers = array(
            array('data' => lang('common_date'), 'align' => 'left'),
            array('data' => lang('common_id'), 'align' => 'left'),
            array('data' => lang('common_sale_id'), 'align' => 'left'),
            array('data' => lang('common_approved'), 'align' => 'left'),
            array('data' => lang('sales_response_description'), 'align' => 'left'),
            array('data' => lang('sales_card_holder'), 'align' => 'left'),
            array('data' => lang('common_amount'), 'align' => 'left'),
            array('data' => lang('sales_transaction_type'), 'align' => 'left'),
            array('data' => lang('sales_entry_method'), 'align' => 'left'),
            array('data' => lang('common_payment_type'), 'align' => 'left'),
            array('data' => lang('sales_masked_card'), 'align' => 'left'),
        );
        
        
        $all_transactions = array();
        
        $transactions = $credit_card_processor->get_transaction_history($params);
        $all_transactions = array_merge($all_transactions, $transactions['transactions']);
        $total_transactions = $transactions['totalResultCount'];
        
        $total_pages = ceil($total_transactions / $params['maxResults']);
        for ($startIndex = $params['maxResults']; $startIndex < $params['maxResults'] * $total_pages; $startIndex += $params['maxResults']) {
            $params['startIndex'] = $startIndex;
            $transactions = $credit_card_processor->get_transaction_history($params);
            $all_transactions = array_merge($all_transactions, $transactions['transactions']);
        }
        
        
        if ($is_portal) {
            for ($k = 0; $k < count($all_transactions); $k++) {
                if ($sale_id = $this->Sale->get_sale_id_from_payment_ref_no($all_transactions[$k]['transactionId'])) {
                    $all_transactions[$k]['sale_id'] = (int)$sale_id;
                    $all_transactions[$k]['receipt_link'] = site_url('sales/receipt/' . $sale_id);
                }
                else {
                    $all_transactions[$k]['sale_id'] = NULL;
                    $all_transactions[$k]['receipt_link'] = NULL;
                }
                
                
            }
            
            echo json_encode($all_transactions);
        }
        else {
            $transaction_types = array('charge', 'refund', 'reverse', 'capture');
            
            $all_transactions = array_filter($all_transactions, function ($transaction) use ($transaction_types) {
                if (in_array($transaction['transactionType'], $transaction_types)) {
                    if ($this->input->get('show_declines')) {
                        return TRUE;
                    }
                    else {
                        //Only approved transactions
                        return $transaction['approved'];
                    }
                }
                
                return FALSE;
            });
            
            $all_transaction_ids = array_column($all_transactions, 'transactionId');
            
            //This will pre-warm cache so we don't make a ton of database queries
            $this->Sale->get_sale_id_from_payment_ref_no($all_transaction_ids);
            
            $details_data = array();
            
            foreach ($all_transactions as $transaction) {
                $details_data_row = array();
                $details_data_row[] = array(
                    'data'  => date(get_date_format() . ' ' . get_time_format(), strtotime($transaction['timestamp'])),
                    'align' => 'left'
                );
                $details_data_row[] = array('data' => $transaction['transactionId'], 'align' => 'left');
                
                if ($sale_id = $this->Sale->get_sale_id_from_payment_ref_no($transaction['transactionId'])) {
                    $details_data_row[] = array(
                        'data'  => anchor('sales/receipt/' . $sale_id, $this->config->item('sale_prefix') . ' ' . $sale_id, array('target' => '_blank')),
                        'align' => 'left'
                    );
                }
                else {
                    $details_data_row[] = array('data' => lang('common_unknown'), 'align' => 'left');
                }
                $details_data_row[] = array(
                    'data'  => $transaction['approved'] ? lang('common_yes') : lang('common_no'),
                    'align' => 'left'
                );
                $details_data_row[] = array('data' => $transaction['responseDescription'], 'align' => 'left');
                $details_data_row[] = array('data' => $transaction['cardHolder'], 'align' => 'left');
                $details_data_row[] = array(
                    'data'  => to_currency(make_currency_no_money(($transaction['approved'] ? $transaction['authorizedAmount'] : $transaction['requestedAmount']))) . (!$transaction['approved'] ? ' (<strong style="color: red">' . lang('common_declined') . '</strong>)' : ''),
                    'align' => 'left'
                );
                $details_data_row[] = array('data' => $transaction['transactionType'], 'align' => 'left');
                $details_data_row[] = array('data' => $transaction['entryMethod'], 'align' => 'left');
                $details_data_row[] = array('data' => $transaction['paymentType'], 'align' => 'left');
                $details_data_row[] = array('data' => $transaction['maskedPan'], 'align' => 'left');
                
                $details_data[] = $details_data_row;
                
            }
            
            
            $data = array(
                "headers"      => $headers,
                "details_data" => $details_data
            );
            
            echo json_encode($data);
        }
    }
    
    function void_return_by_transaction_id($transactionId) {
        $this->check_action_permission('delete_sale');
        $credit_card_processor = $this->_get_cc_processor();
        
        if (!$credit_card_processor || !method_exists($credit_card_processor, 'void_return_transaction_by_id')) {
            return;
        }
        
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $amount = $this->input->post('amount');
        if ($response = $credit_card_processor->void_return_transaction_by_id($transactionId, $amount)) {
            $sale_id = $this->input->post('sale_id');
            $this->load->model('Processing_logging');
            $log_data = array(
                'return_time'                          => date('Y-m-d H:i:s'),
                'employee_id'                          => $this->Employee->get_logged_in_employee_info()->person_id,
                'orig_voided_processor_transaction_id' => $transactionId,
                'voided_processor_transaction_id'      => $response['transactionId'],
                'amount'                               => $response['authorizedAmount'],
                'sale_id'                              => $sale_id ? $sale_id : NULL,
            );
            
            $this->Processing_logging->insert_log($log_data);
            
            $success = rawurlencode(lang('sales_success_void_transaction') . ' ' . $transactionId);
            redirect("coreclear/index?success=$success&start_date=$start_date&end_date=$end_date");
        }
        else {
            $error = rawurlencode(lang('sales_cannot_void_transaction') . ' ' . $transactionId);
            redirect("coreclear/index?error=$error&start_date=$start_date&end_date=$end_date");
        }
    }
    
    function _excel_get_header_row() {
        return array(
            lang('common_date'),
            lang('common_id'),
            lang('common_sale_id'),
            lang('common_approved'),
            lang('sales_response_description'),
            lang('sales_card_holder'),
            lang('common_amount'),
            lang('sales_transaction_type'),
            lang('sales_entry_method'),
            lang('common_payment_type'),
            lang('sales_masked_card')
        );
    }
    
    function excel_export_transaction_history() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $params = [
            'startDate'  => date('c', strtotime($start_date ? $start_date : date('Y-m-d 00:00:00', strtotime('-1 days')))),
            'endDate'    => date('c', strtotime($end_date ? $end_date . ' 23:59:59' : date('Y-m-d 23:59:59', strtotime('+1 days')))),
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        $this->excel_export_history($params, 'coreclear_transaction_history');
    }
    
    function excel_export_transactions_for_portal() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $search = $this->input->get('search');
        $params = [
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        if ($start_date && $end_date) {
            $params['startDate'] = date('c', strtotime($start_date));
            $params['endDate'] = date('c', strtotime($end_date));
        }
        if ($search) {
            $params['query'] = $search;
        }
        
        $this->excel_export_history($params, 'coreclear_transactions', true);
    }
    
    function excel_export_batch_history($batch_id) {
        $params = [
            'batchId'    => $batch_id,
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        $this->excel_export_history($params, 'coreclear_batch_history');
    }
    
    function excel_export_history($params, $file_name, $is_portal = false) {
        ini_set('memory_limit', '1024M');
        set_time_limit(0);
        ini_set('max_input_time', '-1');
        
        $this->load->helper('report');
        
        $credit_card_processor = $this->_get_cc_processor();
        
        $all_transactions = array();
        
        $transactions = $credit_card_processor->get_transaction_history($params);
        $all_transactions = array_merge($all_transactions, $transactions['transactions']);
        $total_transactions = $transactions['totalResultCount'];
        
        $total_pages = ceil($total_transactions / $params['maxResults']);
        for ($startIndex = $params['maxResults']; $startIndex < $params['maxResults'] * $total_pages; $startIndex += $params['maxResults']) {
            $params['startIndex'] = $startIndex;
            $transactions = $credit_card_processor->get_transaction_history($params);
            $all_transactions = array_merge($all_transactions, $transactions['transactions']);
        }
        
        if ($is_portal) {
            $transaction_types = json_decode($this->input->get('transaction_type'));
            if (!count($transaction_types)) {
                $transaction_types = array('charge', 'refund', 'reverse', 'void', 'preauth', 'capture', 'enroll');
            }
        }
        else {
            if (!$this->input->get('transaction_type')) {
                $transaction_types = array('charge', 'refund', 'reverse', 'capture', 'void');
            }
            else {
                $transaction_types = $this->input->get('transaction_type');
            }
        }
        
        $all_transactions = array_filter($all_transactions, function ($transaction) use ($transaction_types) {
            if (in_array($transaction['transactionType'], $transaction_types)) {
                if ($this->input->get('show_declines')) {
                    return TRUE;
                }
                else {
                    //Only approved transactions
                    return $transaction['approved'];
                }
            }
            
            return FALSE;
        });
        
        
        $rows = array();
        
        $header_row = $this->_excel_get_header_row();
        $rows[] = $header_row;
        foreach ($all_transactions as $transaction) {
            $sale_id = $this->Sale->get_sale_id_from_payment_ref_no($transaction['transactionId']) ?: lang('common_unknown');
            
            $amount = $transaction['approved'] ? $transaction['authorizedAmount'] : $transaction['requestedAmount'];
            
            if ($transaction['transactionType'] == 'refund' || $transaction['transactionType'] == 'void' || $transaction['transactionType'] == 'reverse') {
                $amount = make_currency_no_money($amount);
                $amount *= -1;
            }
            
            $row = array(
                date(get_date_format() . ' ' . get_time_format(), strtotime($transaction['timestamp'])),
                $transaction['transactionId'],
                $sale_id,
                $transaction['approved'] ? lang('common_yes') : lang('common_no'),
                $transaction['responseDescription'],
                $transaction['cardHolder'],
                make_currency_no_money($amount, 2, TRUE) . (!$transaction['approved'] ? '(' . lang('common_declined') . ')' : ''),
                $transaction['transactionType'],
                $transaction['entryMethod'],
                $transaction['paymentType'],
                $transaction['maskedPan'],
            );
            
            $rows[] = $row;
        }
        
        $this->load->helper('spreadsheet');
        array_to_spreadsheet($rows, $file_name . '.' . ($this->config->item('spreadsheet_format') == 'XLSX' ? 'xlsx' : 'csv'), TRUE);
    }
    
    function credit_card_payments($days = 30) {
        $this->load->model('Stat');
        echo json_encode($this->Stat->get_credit_card_stats($days));
    }
    
    function get_transactions() {
        $credit_card_processor = $this->_get_cc_processor();
        
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $search = $this->input->get('search');
        $params = [
            'maxResults' => 50,
            'startIndex' => 0,
        ];
        
        if ($search) {
            $params['query'] = $search;
        }
        
        if ($start_date && $end_date) {
            $params['startDate'] = date('c', strtotime($start_date));
            $params['endDate'] = date('c', strtotime($end_date));
        }
        
        $all_transactions = array();
        
        $transactions = $credit_card_processor->get_transaction_history($params);
        $all_transactions = array_merge($all_transactions, $transactions['transactions']);
        $total_transactions = $transactions['totalResultCount'];
        
        $total_pages = ceil($total_transactions / $params['maxResults']);
        for ($startIndex = $params['maxResults']; $startIndex < $params['maxResults'] * $total_pages; $startIndex += $params['maxResults']) {
            $params['startIndex'] = $startIndex;
            $transactions = $credit_card_processor->get_transaction_history($params);
            $all_transactions = array_merge($all_transactions, $transactions['transactions']);
            
        }
        
        $all_transaction_ids = array_column($all_transactions, 'transactionId');
        
        $total_amount = 0;
        foreach ($all_transactions as $transaction) {
            //need to call make_currency_no_money because authorizedAmount has a comma in it and won't add correctly
            $total_amount += $transaction['approved'] ? make_currency_no_money($transaction['authorizedAmount']) : 0;
        }
        
        //This will pre-warm cache so we don't make a ton of database queries
        $this->Sale->get_sale_id_from_payment_ref_no($all_transaction_ids);
        
        for ($k = 0; $k < count($all_transactions); $k++) {
            if ($sale_id = $this->Sale->get_sale_id_from_payment_ref_no($all_transactions[$k]['transactionId'])) {
                $all_transactions[$k]['sale_id'] = (int)$sale_id;
                $all_transactions[$k]['receipt_link'] = site_url('sales/receipt/' . $sale_id);
            }
            else {
                $all_transactions[$k]['sale_id'] = NULL;
                $all_transactions[$k]['receipt_link'] = NULL;
            }
            
            
        }
        
        $data = array(
            'start_date'      => date(get_date_format(), strtotime($start_date ? $start_date : '-1 days')),
            'end_date'        => date(get_date_format(), strtotime($end_date ? $end_date : '+1 day')),
            'transactions'    => $all_transactions,
            'total_amount'    => to_currency($total_amount),
            'length_dropdown' => range($params['maxResults'], $total_pages * $params['maxResults'], 10)
        );
        
        
        echo json_encode($data);
    }
    
    function virtual_terminal_attempt_transaction($type) {
        $this->load->model('Location');
        
        BlockChyp::setApiKey($this->Location->get_info_for_key('blockchyp_api_key'));
        BlockChyp::setBearerToken($this->Location->get_info_for_key('blockchyp_bearer_token'));
        BlockChyp::setSigningKey($this->Location->get_info_for_key('blockchyp_signing_key'));
        
        // These post fields MUST match what we have defined in coreCLEAR views/merchant-tools/VirtualTerminalScreen.vue
        
        switch ($type) {
            case 'Charge':
                $request = [
                    'pan'            => $this->input->post('cardNumber'),
                    'expMonth'       => $this->input->post('expirationMonth'),
                    'expYear'        => $this->input->post('expirationYear'),
                    'cvv'            => $this->input->post('cvv'),
                    'postalCode'     => $this->input->post('postalCode'),
                    'cardholderName' => $this->input->post('cardholderName'),
                    'amount'         => to_currency_no_money($this->input->post('amount')),
                    'tipAmount'      => to_currency_no_money($this->input->post('tipAmount')),
                    'test'           => (boolean)$this->Location->get_info_for_key('blockchyp_test_mode'),
                    'transactionRef' => $this->input->post('transactionReference'),
                    'description'    => $this->input->post('description'),
                ];
                
                $response = BlockChyp::charge($request);
                break;
            case 'Preauth':
                $request = [
                    'pan'            => $this->input->post('cardNumber'),
                    'expMonth'       => $this->input->post('expirationMonth'),
                    'expYear'        => $this->input->post('expirationYear'),
                    'cvv'            => $this->input->post('cvv'),
                    'postalCode'     => $this->input->post('postalCode'),
                    'cardholderName' => $this->input->post('cardholderName'),
                    'amount'         => to_currency_no_money($this->input->post('amount')),
                    'tipAmount'      => to_currency_no_money($this->input->post('tipAmount')),
                    'test'           => (boolean)$this->Location->get_info_for_key('blockchyp_test_mode'),
                    'transactionRef' => $this->input->post('transactionReference'),
                    'description'    => $this->input->post('description'),
                ];
                
                $response = BlockChyp::preauth($request);
                break;
            case 'Refund':
                $request = [
                    'amount'         => to_currency_no_money($this->input->post('amount')),
                    'tipAmount'      => to_currency_no_money($this->input->post('tipAmount')),
                    'test'           => (boolean)$this->Location->get_info_for_key('blockchyp_test_mode'),
                    'transactionRef' => $this->input->post('transactionReference'),
                    'description'    => $this->input->post('description'),
                    'transactionId'  => $this->input->post('transactionId'),
                ];
                
                $response = BlockChyp::refund($request);
                break;
        }
        
        if (isset($request['pan'])) {
            $request['pan'] = 'REMOVED';
        }        
        
        if ($response['success'] && $response['approved']) {
            $customer_info = array('email' => $this->input->post('email'));
            
            $this->_email_virtual_terminal_receipt($customer_info, $request, $response);
        }
        
        echo json_encode($response);
    }
    
    private function _email_virtual_terminal_receipt($customer_info, $cc_request, $cc_response) {
        $data = array();
        $data['customer_info']  = $customer_info;
        $data['cc_request']     = $cc_request;
        $data['cc_response']    = $cc_response;
        
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($this->Location->get_info_for_key('email') ? $this->Location->get_info_for_key('email') : 'no-reply@coreware.com', $this->config->item('company'));
        $this->email->to($customer_info['email']);
        
        if ($this->Location->get_info_for_key('cc_email')) {
            $this->email->cc($this->Location->get_info_for_key('cc_email'));
        }
        
        if ($this->Location->get_info_for_key('bcc_email')) {
            $this->email->bcc($this->Location->get_info_for_key('bcc_email'));
        }
        
        $this->email->subject('Credit Card Transaction Receipt');
        $receipt_data = $this->load->view("coreclear/virtual_terminal_receipt", $data, true);
        $this->email->message($receipt_data);
        
        if ($this->email->send()) {
            $email_status = 1;
        }
        $controller = strtolower(get_class());
        $this->Email_log->add_log($controller, 0, $customer_info['email'], 'Credit Card Transaction Receipt', $email_status,  $receipt_data);
    }
    
    function void_return_for_portal($transactionId) {
        if (!$this->Employee->has_module_action_permission('sales', 'delete_sale', $this->Employee->get_logged_in_employee_info()->person_id)) {
            echo json_encode(array('success' => false, 'message' => 'You do not have permission to void and refund'));
            return;
        }
        
        $void_or_refund = $this->input->post('void_or_refund');
        $amount = $this->input->post('amount') ? $this->input->post('amount') : NULL;
        
        $credit_card_processor = $this->_get_cc_processor();
        
        if (!$credit_card_processor || !method_exists($credit_card_processor, 'void_return_transaction_by_id')) {
            echo json_encode(array('success' => false));
        }
        
        if ($response = $credit_card_processor->void_return_transaction_by_id($transactionId, $amount)) {
            $sale_id = $this->Sale->get_sale_id_from_payment_ref_no($transactionId);
            $this->load->model('Processing_logging');
            $log_data = array(
                'return_time'                          => date('Y-m-d H:i:s'),
                'employee_id'                          => $this->Employee->get_logged_in_employee_info()->person_id,
                'orig_voided_processor_transaction_id' => $transactionId,
                'voided_processor_transaction_id'      => $response['transactionId'],
                'amount'                               => $response['authorizedAmount'],
                'sale_id'                              => $sale_id ? $sale_id : NULL,
            );
            
            $this->Processing_logging->insert_log($log_data);
            
            echo json_encode(array(
                'success' => true,
                'message' => 'Successfully ' . $void_or_refund . ' transaction ' . $transactionId
            ));
        }
        else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Cannot ' . $void_or_refund . ' transaction ' . $transactionId
            ));
        }
    }
    
    function capture_preauth($transactionId) {
        $credit_card_processor = $this->_get_cc_processor();
        
        if (!$credit_card_processor || !method_exists($credit_card_processor, 'capture_preauth_by_transaction_id')) {
            echo json_encode(array('success' => false));
        }
        
        $response = $credit_card_processor->capture_preauth_by_transaction_id($transactionId);
        
        echo json_encode($response);
    }
    
    function get_media() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $page = $this->input->get('page') ?: 1;
        
        $api_data = [
            "page" => $page
        ];
        
        $data = $credit_card_processor->media($api_data);
        echo json_encode($data);
    }
    
    function upload_media() {
        $config['upload_path'] = FCPATH . "assets/";
        $config['allowed_types'] = 'png|jpg|jpeg|gif|mov|mpg|mp4|mpeg';
        
        $this->load->library('upload', $config);
        
        if (isset($_FILES['upload_media']['name']) && !empty($_FILES['upload_media']['name'])) {
            if ($this->upload->do_upload('upload_media')) {
                
                $file_info = $this->upload->data();
                
                $credit_card_processor = $this->_get_cc_processor();
                if ($credit_card_processor) {
                    $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
                }
                
                $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
                if (!$credit_card_processor || !$is_core_clear_processor) {
                    echo json_encode(['success' => false, 'error' => '', 'responseDescription' => '']);
                    return;
                }
                
                if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
                    echo json_encode(['success' => false, 'error' => '', 'responseDescription' => '']);
                    return;
                }
                
                $params = [
                    'fileName'   => $file_info['file_name'],
                    'fileSize' => ($file_info['file_size'] * 10000),
                    'uploadId'   => $this->generateRandomString(20),
                ];
                
                $file = file_get_contents($file_info['full_path']);
                $data = $credit_card_processor->upload_media($params, $file);
                unlink($file_info['full_path']);
                echo json_encode($data);
                return;
            }
            else {
                echo json_encode([
                    'success'             => false,
                    'error'               => $this->upload->display_errors(),
                    'responseDescription' => $this->upload->display_errors()
                ]);
                return;
            }
        }
        else {
            // $this->load->view('upload_media', array('error' => ''));
            // return;
            echo json_encode([
                'success'             => false,
                'error'               => lang('common_something_went_wrong'),
                'responseDescription' => lang('common_something_went_wrong')
            ]);
            return;
        }
    }
    
    function upload_status() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $uploadId = $this->input->get('upload_id');
        $params = [
            'uploadId' => $uploadId
        ];
        $data = $credit_card_processor->upload_status($params);
        echo json_encode($data);
    }
    
    function get_media_asset() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $mediaId = $this->input->get('media_id');
        $params = [
            'mediaId' => $mediaId
        ];
        $data = $credit_card_processor->get_media_asset($params);
        echo json_encode($data);
    }
    
    function delete_media_asset() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $mediaId = $this->input->get('media_id');
        $params = [
            'mediaId' => $mediaId
        ];
        $data = $credit_card_processor->delete_media_asset($params);
        echo json_encode($data);
    }
    
    function slide_shows() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $data = $credit_card_processor->slide_shows([]);
        echo json_encode($data);
    }
    
    function get_slide_show() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $slideShowId = $this->input->get('slide_show_id');
        $params = [
            'slideShowId' => $slideShowId
        ];
        $data = $credit_card_processor->slide_show($params);
        echo json_encode($data);
    }
    
    function update_slide_show() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $name = $this->input->post('name');
        $delay = $this->input->post('delay');
        $slideShowId = $this->input->post('slide_show_id');
        
        function slides($slide) {
            $slide = json_decode($slide);
            
            return [
                'mediaId' => $slide->id ?? $slide->mediaId,
            ];
        }
        
        $slides = array_map('slides', $this->input->post('slides') ?? array());
        
        $params = [
            'name'   => $name,
            'delay'  => (int)$delay,
            'slides' => $slides,
        ];
        
        if (!empty($slideShowId)) {
            $params['id'] = $slideShowId;
        }
        
        $data = $credit_card_processor->update_slide_show($params);
        
        
        echo json_encode($data);
    }
    
    function delete_slide_show() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $slideShowId = $this->input->get('slide_show_id');
        $params = [
            'slideShowId' => $slideShowId,
        ];
        $data = $credit_card_processor->delete_slide_show($params);
        echo json_encode($data);
    }
    
    function terminal_branding() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $data = $credit_card_processor->terminal_branding([]);
        echo json_encode($data);
    }
    
    function update_branding_asset() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $mediaId = $this->input->post('media_id');
        $slideShowId = $this->input->post('slide_show_id');
        $padded = $this->input->post('padded');
        $ordinal = $this->input->post('ordinal');
        $startDate = $this->input->post('start_date');
        $startTime = $this->input->post('start_time');
        $endDate = $this->input->post('end_date');
        $endTime = $this->input->post('end_time');
        $notes = $this->input->post('notes');
        $preview = $this->input->post('preview');
        $enabled = $this->input->post('enabled');
        $brandingAssetId = $this->input->post('asset_id');
        
        function daysOfWeek($day) {
            return $day ? (int) $day : null;
        }
        
        $daysOfWeek = array_map('daysOfWeek', $this->input->post('days_of_week') ?? array());
        
        $params = [
            'mediaId'       => $mediaId,
            'padded'        => (bool)$padded,
            'ordinal'       => $ordinal,
            'startDate'     => $startDate,
            'startTime'     => $startTime,
            'endDate'       => $endDate,
            'endTime'       => $endTime,
            'notes'         => $notes,
            'preview'       => (bool)$preview,
            'enabled'       => (bool)$enabled,
            'daysOfWeek'    => $daysOfWeek,
        ];
                
        if (!empty($brandingAssetId)) {
            $params['id'] = $brandingAssetId;
        }
        
        if (!empty($mediaId)) {
            $params['mediaId'] = $mediaId;
        }
        else if (!empty($slideShowId)) {
            $params['slideShowId'] = $slideShowId;
        }
        
        $data = $credit_card_processor->update_branding_asset($params);
        echo json_encode($data);
    }
    
    function delete_branding_asset() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $assetId = $this->input->get('asset_id');
        $params = [
            'assetId' => $assetId,
        ];
        
        $data = $credit_card_processor->delete_branding_asset($params);
        echo json_encode($data);
    }
    
    function survey_questions() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $data = $credit_card_processor->survey_questions([]);
        echo json_encode($data);
    }
    
    function survey_question() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $questionId = $this->input->get('question_id');
        $params = [
            'questionId' => $questionId
        ];
        $data = $credit_card_processor->survey_question($params);
        echo json_encode($data);
    }
    
    function survey_results() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $questionId = $this->input->get('question_id');
        $params = [
            'questionId' => $questionId
        ];
        $data = $credit_card_processor->survey_results($params);
        echo json_encode($data);
    }

    function update_survey_question() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }

        $questionId = $this->input->post('question_id');
        $ordinal = $this->input->post('ordinal');
        $questionText = $this->input->post('question_text');
        $questionType = $this->input->post('question_type');
        $enabled = $this->input->post('enabled');
        
        $params = [
            'id'   => $questionId,
            'ordinal'      => $ordinal,
            'questionText' => $questionText,
            'questionType' => $questionType,
            'enabled'      => (bool)$enabled,
        ];
        
        
        $data = $credit_card_processor->update_survey_question($params);
        echo json_encode($data);
    }
    
    function delete_survey_question() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $questionId = $this->input->post('question_id');
        $params = [
            'questionId' => $questionId,
        ];
        
        $data = $credit_card_processor->delete_survey_question($params);
        echo json_encode($data);
    }
    
    function terms_templates() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        
        $data = $credit_card_processor->tc_templates([]);
                
        echo json_encode($data);
    }
    
    function terms_template() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $templateId = $this->input->get('template_id');
        $params = [
            'templateId' => $templateId
        ];
        $data = $credit_card_processor->tc_template($params);
        
        
        echo json_encode($data);
    }
    
    function update_terms_template() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $templateId = $this->input->post('template_id');
        $alias = $this->input->post('alias');
        $name = $this->input->post('name');
        $content = $this->input->post('content');
        
        $params = [
            'id'   => $templateId,
            'alias'      => $alias,
            'name' => $name,
            'content' => $content,
        ];
        $data = $credit_card_processor->tc_update_template($params);
        
        
        echo json_encode($data);
    }
    
    function delete_terms_template() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        $templateId = $this->input->post('template_id');
        $params = [
            'templateId' => $templateId,
        ];
        
        $data = $credit_card_processor->tc_delete_template($params);
        
        
        echo json_encode($data);
    }
    
    function terms_log() {
        $credit_card_processor = $this->_get_cc_processor();
        if ($credit_card_processor) {
            $cc_processor_class_name = strtoupper(get_class($credit_card_processor));
        }
        
        $is_core_clear_processor = strpos(strtoupper($this->Location->get_info_for_key('credit_card_processor')), 'CORE') !== false;
        if (!$credit_card_processor || !$is_core_clear_processor) {
            echo json_encode(['success' => false]);
            return;
        }
        
        if ($cc_processor_class_name != 'CORECLEARBLOCKCHYPPROCESSOR') {
            echo json_encode(['success' => false]);
            return;
        }
        
        $data = $credit_card_processor->tc_log([]);
        
        
        echo json_encode($data);
    }
    
    function generateRandomString($length = 10) { //generate random string in length
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

?>
