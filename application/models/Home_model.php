<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handle database functions
 * @author : DEarTh
 */
class Home_model extends CI_Model {

	static $col_array;

	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		self::$col_array = new stdClass();
        self::$col_array->rp_requests = ['id','request_type','report_id','name','company_name','company_email','designation','contact_no','message','date_request'];
        self::$col_array->rp_orders = ['id','report_id','name','company_name','email','contact_no','license_type','price','date_order'];
	}
	
	/**
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($username, $email, $password) {
		
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'password'   => $this->hash_password($password),
			'status'     => 1,
			'is_admin'   => 1,
			'created_at' => date('Y-m-j H:i:s'),
			'modified_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('rp_users', $data);
		
	}
	
	/**
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		
		$this->db->select('password');
		$this->db->from('rp_users');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	
	/**
	 * @param mixed $username
	 * @return int user_id
	 */
	public function get_user_id_from_username($username) {
		
		$this->db->select('id');
		$this->db->from('rp_users');
		$this->db->where('username', $username);

		return $this->db->get()->row('id');
		
	}
	
	/**
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {
		
		$this->db->from('rp_users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * @param mixed $password
	 * @return string|bool success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}

	public function insertRequest( $postData=null ) {
        // remove anything which is not a column our db
        $postData = $this->filter_columns( $postData,self::$col_array->rp_requests );
        if ( $postData ) {
            $postData['date_request'] = date('Y:m:d H:i:s');
            $this->db->insert('rp_requests',$postData);
            return $this->db->insert_id();
        }
        return false;
    }

    public function insertBuyNow( $postData=null ) {
        // remove anything which is not a column our db
        $postData = $this->filter_columns( $postData,self::$col_array->rp_orders );
        if ( $postData ) {
            $postData['date_order'] = date('Y:m:d H:i:s');
            $this->db->insert('rp_orders',$postData);
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
