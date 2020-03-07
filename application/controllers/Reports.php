<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	static $status_list = array(
		    0 => array("danger" => "Closed"),
		    1 => array("success" => "Active")
		);

	static $blog_type = array(
		1 => array("bg-blue-soft" => 'Article'),
		2 => array("bg-purple-studio" => 'News'),
		3 => array("bg-yellow-casablanca" => 'Press-Release'),
	);

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('Report_model');
        $this->load->helper( 'form' );
		$this->load->library( 'form_validation' );
		// $this->output->enable_profiler(TRUE);
    }

    public function index()
	{ 
		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$this->load->view('admin/header');
		$this->load->view('admin/reports', $data);
		$this->load->view('admin/footer');		
	}

	public function requests( $id=null ) { 
		$this->isUserLoggedIn(true);
		$data = new stdClass();
		if ( $id ) {
			$request = $this->Report_model->getRequestById($id);
			if($request){
				$data->request = $request;
			}

			$this->load->view('admin/header');
			$this->load->view('admin/view_request', $data);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/header');
			$this->load->view('admin/requests', $data);
			$this->load->view('admin/footer');
		}
	}

	public function add_report($id=null)
	{
		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$message = new stdClass();
		$checkValidation = $this->__setFormRules('report_add');
		if($checkValidation){

			$postData = $this->input->post();
			$report_id = $this->Report_model->insertReport($postData);
			if($report_id){
				redirect('admin/reports');
			}else{
				$data->message = new stdClass();
				$data->message->type = 'warning';
				$data->message->content = 'No changes were made !';
			}
		}
		$result = $this->Report_model->getCategories(array('status'=>1));
		$data->categories = $result->result;

		$data->report = $this->Report_model->getReportById($id);
		$this->load->view('admin/header',$message);
		$this->load->view('admin/add_report',$data);
		$this->load->view('admin/footer');		
	}

	// Function to generate json data of request for datatable
	public function get_requests_ajax(){
		if(!$this->isUserLoggedIn()){
			return false;
		}

		$data = new stdClass();
		$iTotalRecords = 0;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayStart = intval($_REQUEST['start']);

		$order = $_REQUEST['order'];
		$search = $_REQUEST['search'];
		$columns = $_REQUEST['columns'];

		$where = array(
		  	'start' => $iDisplayStart,
		  	'limit' => $iDisplayLength,
		  	'order_by' => isset($columns[$order[0]['column']]) ? $columns[$order[0]['column']]['name'] : 'date_request',
		  	'sort' => $order[0]['dir'],
		);

		$request_date_from 	= isset($_REQUEST['request_date_from']) ? $_REQUEST['request_date_from'] : '';
		$request_date_to 	= isset($_REQUEST['request_date_to']) ? $_REQUEST['request_date_to'] : '';
		$report_title 	= isset($_REQUEST['report_title']) ? $_REQUEST['report_title'] : '';
		$name 			= isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
		$message 		= isset($_REQUEST['message']) ? $_REQUEST['message'] : '';
		$contact_no 	= isset($_REQUEST['contact_no']) ? $_REQUEST['contact_no'] : '';
		$request_type 	= isset($_REQUEST['request_type']) ? $_REQUEST['request_type'] : '';
		$company_email 	= isset($_REQUEST['company_email']) ? $_REQUEST['company_email'] : '';

		if ( isset($report_title) && strlen($report_title) > 0 ) {
			$where['like']['rp.meta_title'] = $report_title;
		}
		if ( isset($company_email) && $company_email != '' ) {
			$where['like']['company_email'] = $company_email;
		}
		if ( isset($name) && $name != '' ) {
			$where['like']['name'] = $name;
		}
		if ( isset($contact_no) && $contact_no != '' ) {
			$where['like']['contact_no'] = $contact_no;
		}
		if ( isset($message) && $message != '' ) {
			$where['like']['message'] = $message;
		}
		if ( isset($request_type) && $request_type != '' ) {
			$where['request_type'] = $request_type;
		}
		if ( isset($request_date_from) && !empty($request_date_from) ) {
			$where['date_request >='] = date('Y-m-d H:i:s',strtotime($request_date_from));
		}
		if ( isset($request_date_to)  && !empty($request_date_to) ) {
			$where['date_request <'] = date('Y-m-d H:i:s',strtotime($request_date_to."+1 day"));
		}

		$data->requests = $this->Report_model->getRequests($where);
		$records = array("data"=>array());

		$request_types = array(
		    'request-sample' => "Request Sample",
			'speak-to-analyst' => "Speak To Analyst",
			'report-customization' => "Report Customization",
			'inquiry-before-buying' => "Inquiry Before Buying",
			'request-toc' => "Request TOC",
		);

		if ( count($data->requests->result) > 0 ) {
	  		$iTotalRecords = $data->requests->count;
	  		foreach ($data->requests->result as $key => $request) {
	  			$records["data"][] = array(
						      $request->id,
						      '<a href="'.base_url('industry-reports/'.$request->url).'">'.$request->meta_title.'</a>',
						      '<span class="label label-sm label-'.$request->request_type.'">'.$request_types[$request->request_type].'</span>',
						      htmlspecialchars($request->name),
						      htmlspecialchars($request->contact_no),
						      htmlspecialchars($request->company_email),
						      htmlspecialchars($request->message),
						      date('Y-m-d',strtotime($request->date_request)),
						      '<a href="'.base_url('admin/requests/'.$request->id).'" title="View Request Details" target="_blank" class="btn btn-sm btn-outline blue-sharp"><i class="fa fa-search"></i> View</a>
						      <a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird delete_request" data-id="'.$request->id.'"><i class="fa fa-trash"></i> Delete</a>',
						   );
	  		}
		}

		$records["draw"] = intval($_REQUEST['draw']);
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		  
		echo json_encode($records);
	}

	// Function to generate json data of reports for datatable
	public function get_reports_ajax(){
		if(!$this->isUserLoggedIn()){
			return false;
		}

		$data = new stdClass();
		$iTotalRecords = 0;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayStart = intval($_REQUEST['start']);

		$order = $_REQUEST['order'];
		$search = $_REQUEST['search'];
		$columns = $_REQUEST['columns'];

		$where = array(
		  	'start' => $iDisplayStart,
		  	'limit' => $iDisplayLength,
		  	'order_by' => isset($columns[$order[0]['column']]) ? $columns[$order[0]['column']]['name'] : 'date_published',
		  	'sort' => $order[0]['dir'],
		);

		$report_title 			= isset($_REQUEST['report_title']) ? $_REQUEST['report_title'] : '';
		$report_url 			= isset($_REQUEST['report_url']) ? $_REQUEST['report_url'] : '';
		$report_status 			= isset($_REQUEST['report_status']) ? $_REQUEST['report_status'] : '';
		$no_of_pages_from 		= isset($_REQUEST['no_of_pages_from']) ? $_REQUEST['no_of_pages_from'] : '';
		$no_of_pages_to 		= isset($_REQUEST['no_of_pages_to']) ? $_REQUEST['no_of_pages_to'] : '';
		$date_published_from 	= isset($_REQUEST['date_published_from']) ? $_REQUEST['date_published_from'] : '';
		$date_published_to 		= isset($_REQUEST['date_published_to']) ? $_REQUEST['date_published_to'] : '';

		if ( isset($report_title) && strlen($report_title) > 0 ) {
			$where['like']['title'] = $report_title;
		}
		if ( isset($report_url) && strlen($report_url) > 0 ) {
			$where['like']['url'] = $report_url;
		}
		if ( isset($report_status) && $report_status != '' && in_array($report_status, array_keys(self::$status_list)) ) {
			$where['status'] = $report_status;
		}
		if ( isset($no_of_pages_from) && (int) $no_of_pages_from > 0 ) {
			$where['no_of_pages >='] = $no_of_pages_from;
		}
		if ( isset($no_of_pages_to) && (int) $no_of_pages_to > 0 ) {
			$where['no_of_pages <='] = $no_of_pages_to;
		}
		if ( isset($date_published_from) && !empty($date_published_from) ) {
			$where['date_published >='] = date('Y-m-d H:i:s',strtotime($date_published_from));
		}
		if ( isset($date_published_to)  && !empty($date_published_to) ) {
			$where['date_published <'] = date('Y-m-d H:i:s',strtotime($date_published_to."+1 day"));
		}

		$data->reports = $this->Report_model->getReports($where);
		$records = array("data"=>array());

		if ( count($data->reports->result) > 0 ) {
	  		$iTotalRecords = $data->reports->count;
	  		foreach ($data->reports->result as $key => $report) {
	  			$status = self::$status_list[$report->status];
	  			$records["data"][] = array(
						      $report->id,
						      htmlspecialchars($report->title),
						      '<a href="'.$report->url.'">'.$report->url.'</a>',
						      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
						      $report->no_of_pages,
						      date('Y-m-d',strtotime($report->date_published)),
						      '<a href="'.base_url('admin/reports/edit_report/').$report->id.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i> Edit</a>
						      <a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird delete_report" data-id="'.$report->id.'"><i class="fa fa-trash"></i> Delete</a>',
						   );
	  		}
		}

		$records["draw"] = intval($_REQUEST['draw']);
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		  
		echo json_encode($records);
	}


	public function get_users_ajax(){
		if(!$this->isUserLoggedIn()){
			return false;
		}
		$this->load->model('Users_model');
		
		$data = new stdClass();
		$iTotalRecords = 0;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayStart = intval($_REQUEST['start']);

		$order = $_REQUEST['order'];
		$search = $_REQUEST['search'];
		$columns = $_REQUEST['columns'];

	
		$where = array(
		  	'start' => $iDisplayStart,
		  	'limit' => $iDisplayLength,
		  	'order_by' => isset($columns[1]['name']) ? $columns[1]['name'] : 'created_at',
		  	'sort' => $order[0]['dir'],
		);
		$user_name 			= isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
		$user_status 			= isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
		$is_admin 			= isset($_REQUEST['is_admin']) ? $_REQUEST['is_admin'] : '';
		$user_email 		= isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
		$created_at 		= isset($_REQUEST['created_at']) ? $_REQUEST['created_at'] : '';
		$modified_at 	= isset($_REQUEST['modified_at']) ? $_REQUEST['modified_at'] : '';

		if ( isset($name) && $name != '' ) {
			$where['like']['username'] = $user_name;
		}
		if ( isset($is_admin) ) {
			$where['like']['is_admin'] = $is_admin;
		}
		if ( isset($user_status) && $user_status != '' && in_array($user_status, array_keys(self::$user_list)) ) {
			$where['status'] = $user_status;
		}
		if ( isset($company_email) && $company_email != '' ) {
			$where['like']['email'] = $user_email;
		}
		
		if ( isset($created_at) && !empty($created_at) ) {
			$where['created_at >='] = date('Y-m-d H:i:s',strtotime($created_at));
		}
		if ( isset($modified_at)  && !empty($modified_at) ) {
			$where['modified_at <'] = date('Y-m-d H:i:s',strtotime($modified_at."+1 day"));
		}

		$data->users = $this->Users_model->getUsers($where);
		$records = array("data"=>array());

		if ( count($data->users->result) > 0 ) {
			$iTotalRecords = $data->users->count;
	  		foreach ($data->users->result as $key => $user) {
				  $status = self::$status_list[$user->status];
				//   $records["data"][] = $user;
	  			$records["data"][] = array(
						      $user->id,
						      htmlspecialchars($user->username),
						      '<a href="'.$user->email.'">'.$user->email.'</a>',
						      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
						      $user->is_admin,
						      date('Y-m-d',strtotime($user->created_at)),
						      '<a href="'.base_url('admin/users/edit_user/').$user->id.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i> Edit</a>
						      <a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird delete_user" data-id="'.$user->id.'"><i class="fa fa-trash"></i> Delete</a>',
						   );
			  }
		}

		$records["draw"] = intval($_REQUEST['draw']);
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		  
		echo json_encode($records);
	}


    public function categories() {

		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$this->load->view('admin/header');
		$this->load->view('admin/categories', $data);
		$this->load->view('admin/footer');		
	}

	public function add_category($id=null) {

		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$checkValidation = $this->__setFormRules('category_add');
		if($checkValidation){
			$postData = $this->input->post();
			$category_id = $this->Report_model->insertCategory($postData);
			if($category_id){
				redirect('admin/reports/categories');
			}else{
				$data->message = new stdClass();
				$data->message->type = 'warning';
				$data->message->content = 'No changes were made !';
			}
		}

		$data->category = $this->Report_model->getCategoryById($id);

		$this->load->view('admin/header');
		$this->load->view('admin/add_category',$data);
		$this->load->view('admin/footer');		
	}

	public function delete_request() {

		if(!$this->isUserLoggedIn()){
			return false;
		}
		$data = new stdClass();
		$postData = $this->input->post();
		if(isset($postData['id'])){
			return $this->Report_model->deleteRequest($postData['id']);
		}
		return false;
	}

	public function delete_category() {

		if(!$this->isUserLoggedIn()){
			return false;
		}
		$data = new stdClass();
		$postData = $this->input->post();
		if(isset($postData['id'])){
			return $this->Report_model->deleteCategory($postData['id']);
		}
		return false;
	}

	public function delete_report()	{

		if(!$this->isUserLoggedIn()){
			return false;
		}
		$data = new stdClass();
		$postData = $this->input->post();
		if(isset($postData['id'])){
			return $this->Report_model->deleteReport($postData['id']);
		}
		return false;
	}

	public function delete_user() {
		if(!$this->isUserLoggedIn()){
			return false;
		}
		$this->load->model('Users_model');
		$data = new stdClass();
		$postData = $this->input->post();
		if(isset($postData['id'])){
			return $this->Users_model->deleteUser($postData['id']);
		}
		return false;
	}
	public function delete_blog()	{

		if(!$this->isUserLoggedIn()){
			return false;
		}
		$this->load->model('Blog_model');
		$data = new stdClass();
		$postData = $this->input->post();
		if(isset($postData['id'])){
			return $this->Blog_model->deleteBlog($postData['id']);
		}
		return false;
	}

	public function delete_page()	{

		if(!$this->isUserLoggedIn()){
			return false;
		}
		$this->load->model('Page_model');
		$data = new stdClass();
		$postData = $this->input->post();
		if(isset($postData['id'])){
			return $this->Page_model->deletePage($postData['id']);
		}
		return false;
	}

	// Function to generate json data of categories for datatable
	public function get_categories_ajax(){
		if(!$this->isUserLoggedIn()){
			return false;
		}
		$data = new stdClass();
		$iTotalRecords = 0;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayStart = intval($_REQUEST['start']);

		$order = $_REQUEST['order'];
		$search = $_REQUEST['search'];
		$columns = $_REQUEST['columns'];

		$where = array(
		  	'start' => $iDisplayStart,
		  	'limit' => $iDisplayLength,
		  	'order_by' => isset($columns[$order[0]['column']]) ? $columns[$order[0]['column']]['name'] : 'date_published',
		  	'sort' => $order[0]['dir'],
		);

		$category_title 		= isset($_REQUEST['category_title']) ? $_REQUEST['category_title'] : '';
		$category_url 			= isset($_REQUEST['category_url']) ? $_REQUEST['category_url'] : '';
		$category_status 		= isset($_REQUEST['category_status']) ? $_REQUEST['category_status'] : '';
		$date_published_from 	= isset($_REQUEST['date_published_from']) ? $_REQUEST['date_published_from'] : '';
		$date_published_to 		= isset($_REQUEST['date_published_to']) ? $_REQUEST['date_published_to'] : '';

		if ( isset($category_title) && strlen($category_title) > 0 ) {
			$where['like']['title'] = $category_title;
		}
		if ( isset($category_url) && strlen($category_url) > 0 ) {
			$where['like']['url'] = $category_url;
		}
		if ( isset($category_status) && $category_status != '' && in_array($category_status, array_keys(self::$status_list)) ) {
			$where['status'] = $category_status;
		}
		if ( isset($date_published_from) && !empty($date_published_from) ) {
			$where['date_published >='] = date('Y-m-d H:i:s',strtotime($date_published_from));
		}
		if ( isset($date_published_to)  && !empty($date_published_to) ) {
			$where['date_published <'] = date('Y-m-d H:i:s',strtotime($date_published_to."+1 day"));
		}

		$data->categories = $this->Report_model->getCategories($where);
		$records = array("data"=>array());

		if ( count($data->categories->result) > 0 ) {
	  		$iTotalRecords = $data->categories->count;
	  		foreach ($data->categories->result as $key => $category) {
	  			$status = self::$status_list[$category->status];
	  			$records["data"][] = array(
						      $category->id,
						      htmlspecialchars($category->title),
						      htmlspecialchars($category->url),
						      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
						      date('Y-m-d',strtotime($category->date_published)),
						      '<a href="'.base_url('admin/reports/edit_category/').$category->id.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i> Edit</a>
						      <a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird delete_category" data-id="'.$category->id.'"><i class="fa fa-trash"></i> Delete</a>',
						   );
	  		}
		}

		$records["draw"] = intval($_REQUEST['draw']);
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		  
		  echo json_encode($records);
	}

	public function blogs()	{

		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$this->load->view('admin/header');
		$this->load->view('admin/blogs', $data);
		$this->load->view('admin/footer');		
	}

	public function pages()	{

		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$this->load->view('admin/header');
		$this->load->view('admin/pages', $data);
		$this->load->view('admin/footer');		
	}

	public function users()	{

		$this->isUserLoggedIn(true);
		$data = new stdClass();
		$this->load->view('admin/header');
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer');		
	}

	public function add_user($id=null) {

		$this->isUserLoggedIn(true);
		$this->load->model('Users_model');
		$data = new stdClass();
		$checkValidation = $this->__setFormRules('user_add');
		if($checkValidation){
			$postData = $this->input->post();
			$user_id = $this->Users_model->insertUser($postData);
			if($user_id){
				redirect('admin/users');
			}else{
				$data->message = new stdClass();
				$data->message->type = 'warning';
				$data->message->content = 'No changes were made !';
			}
		}

		$data->user = $this->Users_model->getUserById($id);

		$this->load->view('admin/header');
		$this->load->view('admin/add_user',$data);
		$this->load->view('admin/footer');		
	}
	public function add_blog($id=null) {

		$this->isUserLoggedIn(true);
		$this->load->model('Blog_model');
		$data = new stdClass();
		$checkValidation = $this->__setFormRules('blog_add');
		if($checkValidation){

			$postData = $this->input->post();
			$blog_id = $this->Blog_model->insertBlog($postData);
			if($blog_id){
				redirect('admin/blogs');
			}else{
				$data->message = new stdClass();
				$data->message->type = 'warning';
				$data->message->content = 'No changes were made !';
			}
		}
		$result = $this->Report_model->getCategories(array('status'=>1));
		$data->categories = $result->result;

		$data->blog = $this->Blog_model->getBlogById($id);
		$this->load->view('admin/header');
		$this->load->view('admin/add_blog',$data);
		$this->load->view('admin/footer');		
	}

	public function add_page($id=null) {

		$this->isUserLoggedIn(true);
		$this->load->model('Page_model');
		$data = new stdClass();
		$checkValidation = $this->__setFormRules('page_add');
		if($checkValidation){

			$postData = $this->input->post();
			$page_id = $this->Page_model->insertPage($postData);
			if($page_id){
				redirect('admin/pages');
			}else{
				$data->message = new stdClass();
				$data->message->type = 'warning';
				$data->message->content = 'No changes were made !';
			}
		}

		$data->page = $this->Page_model->getPageById($id);
		$this->load->view('admin/header');
		$this->load->view('admin/add_page',$data);
		$this->load->view('admin/footer');		
	}

	// Function to generate json data of blogs for datatable
	public function get_blogs_ajax(){
		if(!$this->isUserLoggedIn()){
			return false;
		}
		$this->load->model('Blog_model');
		$data = new stdClass();
		$iTotalRecords = 0;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayStart = intval($_REQUEST['start']);

		$order = $_REQUEST['order'];
		$search = $_REQUEST['search'];
		$columns = $_REQUEST['columns'];

		$where = array(
		  	'start' => $iDisplayStart,
		  	'limit' => $iDisplayLength,
		  	'order_by' => isset($columns[$order[0]['column']]) ? $columns[$order[0]['column']]['name'] : 'date_published',
		  	'sort' => $order[0]['dir'],
		);

		$blog_title 			= isset($_REQUEST['blog_title']) ? $_REQUEST['blog_title'] : '';
		$blog_url 				= isset($_REQUEST['blog_url']) ? $_REQUEST['blog_url'] : '';
		$blog_status 			= isset($_REQUEST['blog_status']) ? $_REQUEST['blog_status'] : '';
		$blog_type 				= isset($_REQUEST['blog_type']) ? $_REQUEST['blog_type'] : '';
		$date_published_from 	= isset($_REQUEST['date_published_from']) ? $_REQUEST['date_published_from'] : '';
		$date_published_to 		= isset($_REQUEST['date_published_to']) ? $_REQUEST['date_published_to'] : '';

		if ( isset($blog_title) && strlen($blog_title) > 0 ) {
			$where['like']['title'] = $blog_title;
		}
		if ( isset($blog_url) && strlen($blog_url) > 0 ) {
			$where['like']['url'] = $blog_url;
		}
		if ( isset($blog_status) && $blog_status != '' && in_array($blog_status, array_keys(self::$status_list)) ) {
			$where['status'] = $blog_status;
		}
		if ( isset($blog_type) && $blog_type != '' && in_array($blog_type, array_keys(self::$blog_type)) ) {
			$where['type'] = $blog_type;
		}
		if ( isset($date_published_from) && !empty($date_published_from) ) {
			$where['date_published >='] = date('Y-m-d H:i:s',strtotime($date_published_from));
		}
		if ( isset($date_published_to)  && !empty($date_published_to) ) {
			$where['date_published <'] = date('Y-m-d H:i:s',strtotime($date_published_to."+1 day"));
		}

		$data->blogs = $this->Blog_model->getBlogs($where);
		$records = array("data"=>array());

		if ( count($data->blogs->result) > 0 ) {
	  		$iTotalRecords = $data->blogs->count;
	  		foreach ($data->blogs->result as $key => $item) {
	  			$status = self::$status_list[$item->status];
	  			$blog_type = self::$blog_type[$item->type];
	  			$records["data"][] = array(
						      $item->id,
						      htmlspecialchars($item->title),
						      '<a href="'.$item->url.'">'.$item->url.'</a>',
						      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
						      '<span class="label label-sm '.(key($blog_type)).'">'.(current($blog_type)).'</span>',
						      date('Y-m-d',strtotime($item->date_published)),
						      '<a href="'.base_url('admin/blogs/edit_blog/').$item->id.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i> Edit</a>
						      <a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird delete_blog" data-id="'.$item->id.'"><i class="fa fa-trash"></i> Delete</a>',
						   );
	  		}
		}

		$records["draw"] = intval($_REQUEST['draw']);
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		  
		echo json_encode($records);
	}

	// Function to generate json data of pages for datatable
	public function get_pages_ajax(){
		if(!$this->isUserLoggedIn()){
			return false;
		}
		$this->load->model('Page_model');
		$data = new stdClass();
		$iTotalRecords = 0;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayStart = intval($_REQUEST['start']);

		$order = $_REQUEST['order'];
		$search = $_REQUEST['search'];
		$columns = $_REQUEST['columns'];

		$where = array(
		  	'start' => $iDisplayStart,
		  	'limit' => $iDisplayLength,
		  	'order_by' => isset($columns[$order[0]['column']]) ? $columns[$order[0]['column']]['name'] : 'date_published',
		  	'sort' => $order[0]['dir'],
		);

		$page_title 			= isset($_REQUEST['page_title']) ? $_REQUEST['page_title'] : '';
		$page_url 				= isset($_REQUEST['page_url']) ? $_REQUEST['page_url'] : '';
		$page_status 			= isset($_REQUEST['page_status']) ? $_REQUEST['page_status'] : '';
		$date_published_from 	= isset($_REQUEST['date_published_from']) ? $_REQUEST['date_published_from'] : '';
		$date_published_to 		= isset($_REQUEST['date_published_to']) ? $_REQUEST['date_published_to'] : '';

		if ( isset($page_title) && strlen($page_title) > 0 ) {
			$where['like']['title'] = $page_title;
		}
		if ( isset($page_url) && strlen($page_url) > 0 ) {
			$where['like']['url'] = $page_url;
		}
		if ( isset($page_status) && $page_status != '' && in_array($page_status, array_keys(self::$status_list)) ) {
			$where['status'] = $page_status;
		}
		if ( isset($date_published_from) && !empty($date_published_from) ) {
			$where['date_published >='] = date('Y-m-d H:i:s',strtotime($date_published_from));
		}
		if ( isset($date_published_to)  && !empty($date_published_to) ) {
			$where['date_published <'] = date('Y-m-d H:i:s',strtotime($date_published_to."+1 day"));
		}

		$data->pages = $this->Page_model->getPages($where);
		$records = array("data"=>array());

		if ( count($data->pages->result) > 0 ) {
	  		$iTotalRecords = $data->pages->count;
	  		foreach ($data->pages->result as $key => $item) {
	  			$status = self::$status_list[$item->status];
	  			$records["data"][] = array(
						      $item->id,
						      htmlspecialchars($item->title),
						      '<a href="'.$item->url.'">'.$item->url.'</a>',
						      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
						      date('Y-m-d',strtotime($item->date_published)),
						      '<a href="'.base_url('admin/pages/edit_page/').$item->id.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i> Edit</a>
						      <a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird delete_page" data-id="'.$item->id.'"><i class="fa fa-trash"></i> Delete</a>',
						   );
	  		}
		}

		$records["draw"] = intval($_REQUEST['draw']);
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		  
		echo json_encode($records);
	}

	function __setFormRules($setRulesFor = ''){
		switch($setRulesFor){
			case 'report_add':
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('heading', 'Heading', 'trim');
				$this->form_validation->set_rules('url', 'URL', 'trim');
				$this->form_validation->set_rules('category', 'Category', 'trim|required|is_numeric');
				$this->form_validation->set_rules('canonical_tag', 'Canonical Tag', 'trim');
				$this->form_validation->set_rules('short_description', 'Short Description', 'trim');
				$this->form_validation->set_rules('full_description', 'Full Description', 'trim');
				$this->form_validation->set_rules('table_of_content', 'Table Of Content', 'trim');
				$this->form_validation->set_rules('list_of_table', 'List Of Table', 'trim');
				$this->form_validation->set_rules('list_of_charts', 'List Of Charts', 'trim');
				$this->form_validation->set_rules('adjacent_reports', 'Adjacent Report', 'trim');
				$this->form_validation->set_rules('report_code', 'Report Code', 'trim');
				$this->form_validation->set_rules('no_of_pages', 'No Of Pages', 'trim|is_numeric');
				$this->form_validation->set_rules('delivery_format', 'Delivery Format', 'trim');
				$this->form_validation->set_rules('licence_single_user', 'Licence Single User', 'trim|is_numeric');
				$this->form_validation->set_rules('licence_multi_user', 'Licence Multi User', 'trim|is_numeric');
				$this->form_validation->set_rules('licence_corporate', 'Licence Corporate', 'trim|is_numeric');
				$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
				$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
				$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');
			break;

			case 'blog_add':
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('url', 'Url', 'trim');
				$this->form_validation->set_rules('category', 'Category', 'trim|required|is_numeric');
				$this->form_validation->set_rules('short_description', 'Short Description', 'trim');
				$this->form_validation->set_rules('full_description', 'Full Description', 'trim');
				$this->form_validation->set_rules('type', 'Type', 'trim|is_numeric');
				$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
				$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
				$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');
			break;

			case 'page_add':
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('url', 'Url', 'trim');
				$this->form_validation->set_rules('description', 'Description', 'trim');
				$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
				$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
				$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');
			break;

			case 'category_add':
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('url', 'Url', 'trim');
				$this->form_validation->set_rules('description', 'Description', 'trim|required');
				
			break;

			case 'user_add':
				$this->form_validation->set_rules('username', 'username', 'trim|required');
				$this->form_validation->set_rules('email', 'email', 'trim|required');
				$this->form_validation->set_rules('password', 'password', 'trim|required');

			break;
		}
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert_msg"><button data-dismiss="alert" class="close">×</button><i class="fa fa-times-circle"></i> ', '</div>');
		return $this->form_validation->run();
	
	}

	static function isUserLoggedIn($redirect=false){

		$return = ( isset($_SESSION['username']) && isset($_SESSION['logged_in']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 ) ? true : false;

		if ( $redirect === true && !$return) {
			redirect( 'admin/login' );
		}else{
			return $return;
		}

	}

}