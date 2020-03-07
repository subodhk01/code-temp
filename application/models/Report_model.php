<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    /**
    # Table definition : rp_reports #
    #   Name                Type            Null    Default
    1   id                  int(11)         No      None
    2   title               varchar(255)    No      None
    3   heading             varchar(255)    Yes     NULL
    4   url                 varchar(255)    No      None
    5   category            int(11)         Yes     NULL
    6   canonical_tag       varchar(255)    Yes     NULL
    7   short_description   text            Yes     NULL
    8   full_description    text            Yes     NULL
    9   table_of_content    text            Yes     NULL
    10  list_of_table       text            Yes     NULL
    11  list_of_charts      text            Yes     NULL
    12  adjacent_reports    text            Yes     NULL
    13  report_type         int(2)          No      None
    14  report_code         varchar(255)    No      None
    15  status              tinyint(1)      No      0
    16  no_of_pages         int(11)         Yes     NULL
    17  delivery_format     varchar(255)    Yes     NULL
    18  licence_single_user int(11)         Yes     NULL
    19  licence_multi_user  int(11)         Yes     NULL
    20  licence_corporate   int(11)         Yes     NULL
    21  date_published      datetime        No      None
    22  date_modified       datetime        No      CURRENT_TIMESTAMP
    23  meta_title          varchar(255)    Yes     NULL
    24  meta_description    text            Yes     NULL
    25  meta_keywords       text            Yes     NULL
    **/


    static $col_array;

    public function __construct()
    {
        parent::__construct();
        self::$col_array = new stdClass();
        self::$col_array->rp_reports = ['id','title','url','category','short_description','full_description','table_of_content','list_of_table','list_of_charts','status','no_of_pages','delivery_format','licence_single_user','licence_multi_user','licence_corporate','date_published','date_modified','meta_title','meta_description','meta_keywords','heading','report_code','report_type','adjacent_reports','canonical_tag'];
        self::$col_array->rp_categories = ['id','title','url','description','status','date_published','date_modified'];
        self::$col_array->rp_requests = ['id','request_type','report_id','name','company_name','company_email','designation','contact_no','message','date_request'];
    }

    public function getRequests( $data=array() ) {
        // id,title,url,category,short_description,full_description,table_of_content,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords,heading,report_code,report_type,adjacent_reports,canonical_tag
        $this->db->select('rq.id, rq.request_type, rq.report_id, rq.name, rq.company_name, rq.company_email, rq.designation, rq.contact_no, rq.message, rq.date_request, rp.meta_title, rp.url');
        $this->db->from('rp_requests as rq');
        $this->db->join('rp_reports as rp', 'rq.report_id = rp.id');

        $order_array = array('rq.id', 'rq.request_type', 'rq.report_id', 'rq.name', 'rq.company_name', 'rq.company_email', 'rq.designation', 'rq.contact_no', 'rq.message', 'rq.date_request', 'rp.meta_title', 'rp.url');

        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], $order_array)) {
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
            $data = $this->filter_columns( $data,self::$col_array->rp_requests );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();
        // echo $this->db->last_query();

        $result->count = $this->db->from('rp_requests')->where($data)->count_all_results();

        return $result;
    }

    public function getRequestById($id){
        $this->db->select('rq.id, rq.request_type, rq.report_id, rq.name, rq.company_name, rq.company_email, rq.designation, rq.contact_no, rq.message, rq.date_request, rp.meta_title, rp.url');
        $this->db->from('rp_requests as rq');
        $this->db->join('rp_reports as rp', 'rq.report_id = rp.id');
        $this->db->where('rq.id',$id);
        return $this->db->get()->row_object();
    }

    public function getReports( $data=array() ) {
        // id,title,url,category,short_description,full_description,table_of_content,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords,heading,report_code,report_type,adjacent_reports,canonical_tag
        $this->db->select('id,title,url,category,short_description,full_description,table_of_content,list_of_table,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords,heading,report_code,report_type,adjacent_reports,canonical_tag');
        $this->db->from('rp_reports');

        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], self::$col_array->rp_reports)) {
                $sort = isset($data['sort']) && in_array( strtolower($data['sort']), ['asc','desc'] ) ? $data['sort'] : 'desc';
                $this->db->order_by($data['order_by'], $sort);
            }

            if( isset($data['limit']) && isset($data['start']) ) {
                $limit = is_int($data['limit']) ? $data['limit'] : 10;
                $start = is_int($data['start']) ? $data['start'] : 0;
                $this->db->limit($limit, $start);
            }

            if ( isset($data['like']) ) {
                $i = 0;
                foreach ($data['like'] as $key => $value) {
                    if( $i == 0 ){
                        $this->db->like($key, $value);
                    }else{
                        $this->db->or_like($key, $value);
                    }
                    $i++;
                }
            }

            // remove anything which is not a column our db
            $data = $this->filter_columns( $data,self::$col_array->rp_reports );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();
        // echo $this->db->last_query();

        $result->count = $this->db->from('rp_reports')->where($data)->count_all_results();

        return $result;
    }
    public function getReportById($id){
        $this->db->select('id,title,url,category,short_description,full_description,table_of_content,list_of_table,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords,heading,report_code,report_type,adjacent_reports,canonical_tag');
        $this->db->from('rp_reports');
        $this->db->where('id',$id);
        return $this->db->get()->row_object();
    }

    public function deleteRequest($id){
        $this->db->where('id',$id);
        $this->db-> delete('rp_requests');
        return $this->db->affected_rows();
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
        $this->db->select('id,title,url,description,status,date_published,date_modified');
        $this->db->from('rp_categories');

        if ( !empty($data) && is_array($data) ) {
            if (isset($data['order_by']) && in_array($data['order_by'], self::$col_array->rp_categories)) {
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
            $data = $this->filter_columns( $data,self::$col_array->rp_categories );
            $this->db->where($data);

        }

        $result = new stdClass();

        $result->result = $this->db->get()->result_object();

        $result->count = $this->db->from('rp_categories')->where($data)->count_all_results();

        return $result;
    }
    public function getCategoryById($id){
        $this->db->select('id,title,url,description,status,date_published,date_modified');
        $this->db->from('rp_categories');
        $this->db->where('id',$id);
        return $this->db->get()->row_object();
    }
    public function getCategoryBySlug($slug){
        $this->db->select('id,title,url,description,status,date_published,date_modified');
        $this->db->from('rp_categories');
        $this->db->where('url',$slug);
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

    public function getReportBySlug($slug){
        $this->db->select('id,title,url,category,short_description,full_description,table_of_content,list_of_table,list_of_charts,status,no_of_pages,delivery_format,licence_single_user,licence_multi_user,licence_corporate,date_published,date_modified,meta_title,meta_description,meta_keywords,heading,report_code,report_type,adjacent_reports,canonical_tag');
        $this->db->from('rp_reports');
        $this->db->where('url',$slug);
        return $this->db->get()->row_object();
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