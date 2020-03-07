<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Paypal_model extends CI_Model {

	static $col_array;
	function __construct() {
		parent::__construct();
		self::$col_array = new stdClass();
		self::$col_array->rp_payments = ['payment_gateway','payer_email','payer_id','payer_status','first_name','last_name','address_name','address_street','address_city','address_state','address_country_code','address_zip','residence_country','txn_id','mc_currency','mc_gross','protection_eligibility','payment_gross','payment_status','pending_reason','payment_type','handling_amount','shipping','item_name','item_number','quantity','txn_type','payment_date','notify_version','verify_sign','order_id'];
	}

	public function insertTransaction( $postData=null ) {
        // remove anything which is not a column our db
        $postData = $this->filter_columns( $postData,self::$col_array->rp_payments );
        if ( $postData ) {
            $this->db->insert('rp_payments',$postData);
            return $this->db->insert_id();
        }
        return false;
    }

    public function filter_columns ( $postData,$cols ) {
        if ( is_array($postData) && is_array($cols) ) {
            foreach ( $postData as $key => $value ) {
                if ( !in_array($key,$cols) ) {
                    // this might be a filter column
                    $sub_str = explode(' ', $key);
                    if( isset($sub_str[0]) &&  !in_array($sub_str[0],$cols) ) {
                        // remove element if not a db table column
                        unset($postData[$key]);
                    }
                }
            }
            return $postData;
        }
        return false;
    }

}