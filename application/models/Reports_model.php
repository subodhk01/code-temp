<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

    /*
    #Table definition#
    ###Column_Name         #Type           #NULL   #Default
    1   id                  int(11)         No      None
    2   title               varchar(255)    No      None
    3   url                 varchar(255)    No      None
    4   category            int(11)         Yes     NULL
    5   short_description   text            Yes     NULL
    6   full_description    text            Yes     NULL
    7   table_of_content    text            Yes     NULL
    8   list_of_table       text            Yes     NULL
    9   list_of_charts      text            Yes     NULL
    10  status              int(11)         No      0
    11  no_of_pages         int(11)         Yes     NULL
    12  delivery_format     int(1)          Yes     NULL
    13  licence_single_user int(11)         Yes     NULL
    14  licence_multi_user  int(11)         Yes     NULL
    15  licence_corporate   int(11)         Yes     NULL
    16  date_published      datetime        No      None
    17  date_modified       datetime        No      CURRENT_TIMESTAMP
    18  meta_title          varchar(255)    Yes     NULL
    19  meta_description    text            Yes     NULL
    20  meta_keywords                   
    */

    static $col_array;

    public function __construct()
    {
        parent::__construct();
        self::$col_array = new stdClass();
        self::$col_array->rp_reports = ['id','title','url','category','short_description','full_description','table_of_content','list_of_table','list_of_charts','status','no_of_pages','delivery_format','licence_single_user','licence_multi_user','licence_corporate','date_published','date_modified','meta_title','meta_description','meta_keywords'];
        self::$col_array->rp_categories = ['id','title','description','status','date_published','date_modified'];
    }

	public function getReports( $data=array() ) {
        // id,title,url,category,short_description,full_description,table_of_content,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords
        $this->db->select('id,title,url,category,short_description,full_description,table_of_content,list_of_table,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords');
        $this->db->from('rp_reports');

        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], self::$col_array->rp_reports)) {
                $sort = isset($data['sort']) && in_array( strtolower($data['sort']), ['asc','desc'] ) ? $data['sort'] : 'desc';
                $this->db->order_by($data['order_by'], $sort);
            }

            $limit = isset($data['limit']) && is_int($data['limit']) ? $data['limit'] : 10;
            $start = isset($data['start']) && is_int($data['start']) ? $data['start'] : 0;
            $this->db->limit($limit, $start);

            // remove anything which is not a column our db
            $data = $this->filter_columns( $data,self::$col_array->rp_reports );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();

        $result->count = $this->db->from('rp_reports')->where($data)->count_all_results();

        return $result;
	}
    public function getReportById($id){
        $this->db->select('id,title,url,category,short_description,full_description,table_of_content,list_of_table,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords');
        $this->db->from('rp_reports');
        $this->db->where('id',$id);
        return $this->db->get()->row_object();
    }

    public function deleteCategory($id){
        $this->db->where('id',$id);
        $this->db-> delete('rp_categories');
        return $this->db->affected_rows();
    }

    public function deleteReport($id){
        $this->db->where('id',$id);
        $this->db-> delete('rp_reports');
        return $this->db->affected_rows();
    }

    public function getCategories( $data=array() ) {
        // id,title,url,category,short_description,full_description,table_of_content,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords
        $this->db->select('id,title,description,status,date_published,date_modified');
        $this->db->from('rp_categories');

        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], self::$col_array->rp_categories)) {
                $sort = isset($data['sort']) && in_array( strtolower($data['sort']), ['asc','desc'] ) ? $data['sort'] : 'desc';
                $this->db->order_by($data['order_by'], $sort);
            }

            $limit = isset($data['limit']) && is_int($data['limit']) ? $data['limit'] : 10;
            $start = isset($data['start']) && is_int($data['start']) ? $data['start'] : 0;
            $this->db->limit($limit, $start);

            // remove anything which is not a column our db
            $data = $this->filter_columns( $data,self::$col_array->rp_categories );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();

        $result->count = $this->db->from('rp_categories')->where($data)->count_all_results();

        return $result;
    }
    public function getCategoryById($id){
        $this->db->select('id,title,description,status,date_published,date_modified');
        $this->db->from('rp_categories');
        $this->db->where('id',$id);
        return $this->db->get()->row_object();
    }
	public function insertReport( $postData=null ) {
        // remove anything which is not a column our db
        $postData = $this->filter_columns( $postData,self::$col_array->rp_reports );
        if ( $postData ) {
            if ( isset($postData['id']) ) {
                $this->db->where('id',$postData['id']);
                $this->db->update('rp_reports',$postData);
                $updated_status = $this->db->affected_rows();
                return $updated_status ? $postData['id'] : false;
            }else{
                $postData['date_published'] = date('Y:m:d H:i:s');
                $this->db->insert('rp_reports',$postData);
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function insertCategory( $postData=null ) {
        // remove anything which is not a column our db
        $postData = $this->filter_columns( $postData,self::$col_array->rp_categories );
        if ( $postData ) {
            if ( isset($postData['id']) ) {
                $this->db->where('id',$postData['id']);
                $this->db->update('rp_categories',$postData);
                $updated_status = $this->db->affected_rows();
                return $updated_status ? $postData['id'] : false;
            }else{
                $postData['date_published'] = date('Y:m:d H:i:s');
                $this->db->insert('rp_categories',$postData);
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function post_update( $id=null ) {
        $this->db->select('*');
        $this->db->from('posters');
        $this->db->where('id', $id );
        $query = $this->db->get();
        return $result = $query->row_array();
    }

    public function getposterbyid($id=null){        
        $sql = "SELECT * FROM posters WHERE id = ".$id;
        $query = $this->db->query($sql);
            return TRUE;        
    }

    public function editposters($postData=null){
      $sql2 = "UPDATE posters SET posters_name ='".$postData['posters_name']."' WHERE id = ".$postData['id'];
      $this->db->query($sql2);
      redirect(base_url('posters/posters_show'), 'auto');
      return TRUE;   
    }

    public function deleteposters($id=null){  
        $sql = "SELECT * FROM posters WHERE id = ".$id;  
        $query = $this->db->query($sql);
        $sql2 = "DELETE FROM posters WHERE id = ".$id;
        $this->db->query($sql2);
        redirect(base_url('posters/posters_show'), 'auto');
        return TRUE;	        
    }

    public function filter_columns ( $postData,$cols ) {
        if ( is_array($postData) && is_array($cols) ) {
            foreach ( $postData as $key => $value ) {
                if ( !in_array($key,$cols) ) {
                    // remove element if not a db table column
                    unset($postData[$key]);
                }
            }
            return $postData;
        }
        return false;
    }
}