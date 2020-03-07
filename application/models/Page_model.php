<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

    /**
    # Table definition : rp_pages #
    #   Name                Type            Null    Default
    1   id                  int(11)         No      None
    2   title               varchar(255)    No      None
    3   url                 varchar(255)    Yes     NULL
    4   content             text            Yes     NULL
    5   related_report      text            Yes     NULL
    6   date_published      datetime        No      None
    7   date_modified       datetime        on      CURRENT_TIMESTAMP
    8   meta_title          varchar(255)    Yes     NULL
    9   meta_description    text            Yes     NULL
    10  meta_keywords       text            Yes     NULL
    11  status              tinyint(1)      No      None
    **/

    static $col_array;

    public function __construct()
    {
        parent::__construct();
        self::$col_array = new stdClass();
        self::$col_array->rp_pages = ['id','title','url','content','status','date_published','date_modified','meta_title','meta_description','meta_keywords'];

    }

	public function getPages( $data=array() ) {
        // id,title,url,content,status,date_published,date_modified,meta_title,meta_description,meta_keywords
        $this->db->select('id,title,url,content,status,date_published,date_modified,meta_title,meta_description,meta_keywords');
        $this->db->from('rp_pages');

        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], self::$col_array->rp_pages)) {
                $sort = isset($data['sort']) && in_array( strtolower($data['sort']), ['asc','desc'] ) ? $data['sort'] : 'desc';
                $this->db->order_by($data['order_by'], $sort);
            }

            $limit = isset($data['limit']) && is_int($data['limit']) ? $data['limit'] : 10;
            $start = isset($data['start']) && is_int($data['start']) ? $data['start'] : 0;
            $this->db->limit($limit, $start);

            if ( isset($data['like']) ) {
                $this->db->like($data['like']);
            }

            // remove anything which is not a column our db
            $data = $this->filter_columns( $data,self::$col_array->rp_pages );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();

        $result->count = $this->db->from('rp_pages')->where($data)->count_all_results();

        echo "$result";
        die();
        return $result;
	}
    public function getPageById($id){
        $this->db->select('id,title,url,content,status,date_published,date_modified,meta_title,meta_description,meta_keywords');
        $this->db->from('rp_pages');
        $this->db->where('id',$id);
        return $this->db->get()->row_object();
    }

    public function getPageBySlug($slug){
        $this->db->select('id,title,url,content,status,date_published,date_modified,meta_title,meta_description,meta_keywords');
        $this->db->from('rp_pages');
        $this->db->where('url',$slug);
        return $this->db->get()->row_object();
    }

    public function deletePage($id){
        $this->db->where('id',$id);
        $this->db-> delete('rp_pages');
        return $this->db->affected_rows();
    }

	public function insertPage( $postData=null ) {
        // remove anything which is not a column our db
        $postData = $this->filter_columns( $postData,self::$col_array->rp_pages );
        if ( $postData ) {
            if ( isset($postData['id']) ) {
                $this->db->where('id',$postData['id']);
                $this->db->update('rp_pages',$postData);
                $updated_status = $this->db->affected_rows();
                return $updated_status ? $postData['id'] : false;
            }else{
                $postData['date_published'] = date('Y:m:d H:i:s');
                $this->db->insert('rp_pages',$postData);
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