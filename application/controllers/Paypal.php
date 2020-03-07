<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller{
    
     function  __construct(){
        parent::__construct();
        
        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->model('Report_model');
        $this->load->model('Paypal_model');
     }
     
    function success(){
        // Get the transaction data
        $data = array();
        $paypalInfo = $this->input->post();
        $db_columns = array('payment_gateway','payer_email','payer_id','payer_status','first_name','last_name','address_name','address_street','address_city','address_state','address_country_code','address_zip','residence_country','txn_id','mc_currency','mc_gross','protection_eligibility','payment_gross','payment_status','pending_reason','payment_type','handling_amount','shipping','item_name','item_number','quantity','txn_type','payment_date','notify_version','verify_sign','order_id');
        if ( isset($paypalInfo['payment_status']) ) {
            foreach ($paypalInfo as $key => $value) {
                if(in_array($key, $db_columns)){
                    $data[$key] = $value;
                }
            }
        }

        // Pass the transaction data to view
        $this->load->view( 'header' );
        $this->load->view('success', $data);
        $this->load->view( 'footer' );
    }
     
     function cancel(){
        // Load payment failed view
        $this->load->view( 'header' );
        $this->load->view('cancel');
        $this->load->view( 'footer' );
     }
     
     // this will insert transaction in database
     function ipn(){
        // Paypal posts the transaction data
        $paypalInfo = $this->input->post();
        
        if(!empty($paypalInfo)){
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if($ipnCheck){
                // Insert the transaction data in the database
                $data = array();
                $db_columns = array('payment_gateway','payer_email','payer_id','payer_status','first_name','last_name','address_name','address_street','address_city','address_state','address_country_code','address_zip','residence_country','txn_id','mc_currency','mc_gross','protection_eligibility','payment_gross','payment_status','pending_reason','payment_type','handling_amount','shipping','item_name','item_number','quantity','txn_type','payment_date','notify_version','verify_sign','order_id');
                if ( isset($paypalInfo['payment_status']) ) {
                    foreach ($paypalInfo as $key => $value) {
                        if(in_array($key, $db_columns)){
                            $data[$key] = $value;
                        }
                    }
                    if( !empty($data) ){
                        $data['payment_gateway']    = 'paypal';
                        $data['report_id']          = $paypalInfo['item_number'];
                        $data['order_id']           = $paypalInfo['custom'];
                        $transaction_id = $this->Paypal_model->insertTransaction($data);
                    }
                }
            }
        }
    }

}