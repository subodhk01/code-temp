<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


    static $col_array;

    public function __construct()
    {
        parent::__construct();
        self::$col_array = new stdClass();
        self::$col_array->rp_users = ['id','username','email','status','is_admin','created_at','modified_at'];
        $this->load->model('admin_model');
    }

    protected function generateSalt() {
        $salt = "xiORG17N6ayoEn6X3";
        return $salt;
}
private function hashPassword($password) {
		
    return password_hash($password, PASSWORD_BCRYPT);
    
}
	public function getUsers( $data=array()) {
        // id,title,url,category,short_description,full_description,table_of_content,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords
        $this->db->select('id,username,email,status,is_admin,created_at,modified_at');
        $this->db->from('rp_users');
        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], self::$col_array->rp_users)) {
                $sort = isset($data['sort']) && in_array( strtolower($data['sort']), ['asc','desc'] ) ? $data['sort'] : 'desc';
                $this->db->order_by($data['order_by'], $sort);
            }

            if( isset($data['limit']) && isset($data['start']) ) {
                $limit = is_int($data['limit']) ? $data['limit'] : 10;
                $start = is_int($data['start']) ? $data['start'] : 0;
                $this->db->limit($limit, $start);
            }

            if ( isset($data['like']) ) {
                $this->db->like($data['like']);
            }

            // remove anything which is not a column our db
            $data = $this->filter_columns( $data,self::$col_array->rp_users );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();

        $result->count = $this->db->from('rp_users')->where($data)->count_all_results();

        return $result;
	}
    public function getUserById($id){
        $this->db->select('id,username,email,status,is_admin,created_at,modified_at');
        $this->db->from('rp_users');
        $this->db->where('id',$id);
        return $this->db->get()->row_object();
    }

    public function getUserBySlug($slug){
        $this->db->select('id,username,email,status,is_admin,created_at,modified_at');
        $this->db->from('rp_users');
        $this->db->where('email',$slug);
        return $this->db->get()->row_object();
    }
    public function deleteUser($id){
        $this->db->where('id',$id);
        $this->db-> delete('rp_users');
        return $this->db->affected_rows();
    }

	public function insertUser( $postData=null ) {
        // remove anything which is not a column our db
        $data = array(
            'id'         => $postData['id'],
			'username'   => $postData['username'],
			'email'      => $postData['email'],
			'password'   => $this->hashPassword($this->generateSalt().$postData['password']),
			'status'     => $postData['status'],
			'is_admin'   => $postData['is_admin'],
			'created_at' => date('Y-m-j H:i:s'),
			'modified_at' => date('Y-m-j H:i:s'),
        );
        if ( $data ) {
            if ( isset($data['id']) ) {
                $this->db->where('id',$data['id']);
                $this->db->update('rp_users',$data);
                $updated_status = $this->db->affected_rows();
                return $updated_status ? $data['id'] : false;
            }else{
                $this->db->insert('rp_users',$data);
                return $this->db->insert_id();
            }
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