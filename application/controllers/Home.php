<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	// 1 Article
	// 2 News
	// 3 Press-Release

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('home_model');
		
	}

	static function set_meta_and_title($type='page',$omr_meta=null){
		$meta = new stdClass();
		$meta->page_title = 'Global Consulting | Market Research &amp; Industry Analysis Report | OMR';
		
		if ( $omr_meta ) {
			$url 					= isset($omr_meta->url) && $omr_meta->url ? $omr_meta->url : '';

			if ( $type == 'page' ) {
				$meta->meta_url = base_url().$url;
			} else if ( $type == 'report' ) {
				$meta->meta_url = base_url().'industry-reports/'.$url;
			} else if ( $type == 'press-release' ) {
				$meta->meta_url = base_url().'press-release/'.$url;
			}

			$meta->meta_title 		= isset($omr_meta->meta_title) && $omr_meta->meta_title ? $omr_meta->meta_title : 'OMR Global';
			$meta->page_title 		= isset($omr_meta->meta_title) && $omr_meta->meta_title ? $omr_meta->meta_title : $meta->page_title;
			$meta->meta_description = isset($omr_meta->meta_description) && $omr_meta->meta_description ? $omr_meta->meta_description : '';
			$meta->meta_keywords 	= isset($omr_meta->meta_keywords) && $omr_meta->meta_keywords ? $omr_meta->meta_keywords : '';
		}

		return $meta;
	}

	public function index() {
		$this->load->model('Report_model');
		$this->load->model('Blog_model');

		$data = new stdClass();

		$where = array(
		  	'start' => 0,
		  	'limit' => 5,
		  	'order_by' => 'date_published',
		  	'sort' => 'desc',
		  	'status' => 1,
		);
		$where1 = array(
		  	'start' => 0,
		  	'limit' => 7,
		  	'order_by' => 'date_published',
		  	'sort' => 'desc',
		  	'status' => 1,
		);
		
		$reports = $this->Report_model->getReports($where1);
		if ( count($reports->result) > 0 ) {
			$data->reports = $reports->result;
		}

		$blogs = $this->Blog_model->getBlogs($where);
		if ( count($blogs->result) > 0 ) {
			$data->blogs = $blogs->result;
		}

		$this->load->view( 'header', $this->set_meta_and_title() );
		$this->load->view( 'index', $data );
		$this->load->view( 'footer' );
	}

	public function page_template($page_name) {
		$this->load->model('Page_model');

		$data = new stdClass();

		$segment = $this->uri->segments[1];

		if ( $segment == 'services' ) {
			$page_name = 'services/'.$page_name;
		}

		$data->page = $this->Page_model->getPageBySlug($page_name);

		$this->load->view( 'header', $this->set_meta_and_title('page',$data->page) );
		$this->load->view( 'page_template', $data );
		$this->load->view( 'footer' );
	}

	public function industry_reports($slug=null) {

		$this->load->model('Report_model');

		$data = new stdClass();
		$meta = new stdClass();

		$data->report_single = $this->Report_model->getReportBySlug($slug);

		if ( $data->report_single ) {
			$where = array(
				'start' => 0,
				'limit' => 7,
			  	'order_by' => 'date_published',
			  	'sort' => 'desc',
			  	'status' => 1,
			  	'category' => $data->report_single->category,
			  	'id !=' => $data->report_single->id
			);

			$data->report_single->category = $this->Report_model->getCategoryById($data->report_single->category);
			
			$reports = $this->Report_model->getReports($where);
			if ( count($reports->result) > 0 ) {
				$data->related_reports = $reports->result;
			}

			$meta = $this->set_meta_and_title('report',$data->report_single);
			if($data->report_single){
				$meta->canonical_tag = $data->report_single->canonical_tag;
			}
		} else {
			redirect('reports-category');
		}


		$this->load->view( 'header', $meta );
		$this->load->view( 'reports_single', $data );
		$this->load->view( 'footer' );
	}

	public function reports_category($slug=null) {
		$this->load->model('Report_model');

		$data = new stdClass();
		$search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
		$category = $this->Report_model->getCategoryBySlug($slug);

		$where = array(
		  	'order_by' => 'date_published',
		  	'sort' => 'desc',
		  	'status' => 1,
		);
		if ( $category ) {
			$where['category'] = $category->id;
			$data->current_category = $category;
		}

		if ( !empty($search) ){
			$where['like']['title'] = $search;
			$where['like']['table_of_content'] = $search;
		}
		
		$reports = $this->Report_model->getReports($where);

		if ( count($reports->result) > 0 ) {
			$data->reports = $reports->result;
		}

		$where_cat = array(
		  	'order_by' => 'title',
		  	'sort' => 'asc',
		  	'status' => 1,
		);

		$categories = $this->Report_model->getCategories($where_cat);
		if ( count($categories->result) > 0 ) {
			$data->categories = $categories->result;
		}

		$this->load->view( 'header', $this->set_meta_and_title() );
		$this->load->view( 'category', $data );
		$this->load->view( 'footer' );
	}

	public function contact_us() {
		// load helper and validation library

		$data = new stdClass();
		$data->message = new stdClass();
		// load helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim');
		$this->form_validation->set_rules('subject', 'Subject', 'trim');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		
		if ($this->form_validation->run() !== false) {
			
			$name 			= $this->input->post('name');
			$email    		= $this->input->post('email');
			$company_name 	= $this->input->post('company_name');
			$subject 		= 'Contact Form : '.$this->input->post('subject');
			$message 		= $this->input->post('message');

			// send email
			$email_to = 'tiwari@omrglobal.com';
			$email_to = 'omrglobal@gmail.com';
			$message = 'Name : '.$name.'<br>
						Email : '.$email.'<br>
						Company Name : '.$company_name.'<br>
						Message : '.$message;
			$email_from = 'info@omrglobal.com';
			$this->send_mail( $email_to, $subject, $message, $email_from );

			$data->message->type = 'success';
			$data->message->content = 'Contact form submitted successfully !';
		}

		$meta = $this->set_meta_and_title();
		$meta->page_title = 'Contact Us | Orion Market Research | OMR';

		$this->load->view( 'header', $meta );
		$this->load->view( 'contact_us', $data );
		$this->load->view( 'footer' );
	}

	public function request_page($slug) {

		$data = new stdClass();
		$data->message = new stdClass();
		$data->request = new stdClass();
		// load helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Home_model');
		$this->load->model('Report_model');

		$data->request->type = $this->uri->segments[1];
		$data->request->title = ucwords(str_replace('-',' ',$this->uri->segments[1]));
		$data->request->report_url = $slug;
		$report = $this->Report_model->getReportBySlug($slug);
		$data->request->report_title = $report && isset($report->title) ? $report->title : '';
		
		// set validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('company_email', 'Company email', 'trim|required|valid_email');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('contact_no', 'Contact No.', 'trim|required|numeric');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		
		if ($this->form_validation->run() !== false) {
			
			$postData = $this->input->post();
			if ( !empty($report) ) {
				$postData['report_id'] = $report->id;
				$postData['request_type'] = $data->request->type;
				$request_id = $this->Home_model->insertRequest($postData);
				if ( $request_id ) {

					// Send mail
					$email_to = 'tiwari@omrglobal.com';
					$subject = $data->request->title;
					$message = 'Report URL : '.base_url('industry-reports/'.$report->url).'<br>
								Name : '.$postData['name'].'<br>
								Company Name : '.$postData['company_name'].'<br>
								Company Email : '.$postData['company_email'].'<br>
								Designation : '.$postData['designation'].'<br>
								Contact no : '.$postData['contact_no'].'<br>
								Message : '.$postData['message'];
					$email_from = 'info@omrglobal.com';
					$this->send_mail( $email_to, $subject, $message, $email_from );

					$data->message->type = 'success';
					$data->message->content = 'Request successfully submitted !';
				} else {
					$data->message->type = 'danger';
					$data->message->content = 'Something went wrong, please try again !';
				}
			} else {
				$data->message->type = 'danger';
				$data->message->contenct = 'Report not found !';
			}
		}

		$meta = $this->set_meta_and_title();
		$meta->noindex = true;

		$this->load->view( 'header', $meta );
		$this->load->view( 'request_page', $data );
		$this->load->view( 'footer' );
	}

	public function buy_now($slug) {

		$data = new stdClass();
		$data->message = new stdClass();
		// load helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Home_model');
		$this->load->model('Report_model');

		// set validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('contact_no', 'Contact No.', 'trim|required|numeric');

		$postData = $this->input->post();
		$postData = empty($postData) ? $this->input->get() : $postData;
		$report = $this->Report_model->getReportBySlug($slug);
		if ( !empty($report) ) {
			$data->report_url = $report->url;
			$data->report_title = $report->title;
			$data->license_type = isset($postData['license_type']) ? $postData['license_type'] : 'license-single-user';
			$postData['report_id'] = $report->id;
			$postData['license_type'] = $data->license_type;
			if ( $data->license_type == 'license-single-user' ) {
				$postData['price'] = $report->licence_single_user;
			} else if ( $data->license_type == 'license-multi-user' ) {
				$postData['price'] = $report->licence_multi_user;
			} else if ( $data->license_type == 'license-corporate' ) {
				$postData['price'] = $report->licence_corporate;
			}

			if ($this->form_validation->run() !== false && !empty($report) ) {
				
				$request_id = $this->Home_model->insertBuyNow($postData);
				if ( $request_id ) {
					if ( isset($postData['payment_method']) ) {
						if ( $postData['payment_method'] == 'razorpay' ) {
							$data->itemInfo = array(
				                'description' => $report->title,
				                'price' => $report->licence_single_user,
				                'name' => $report->meta_title,
				                'order_id' => $request_id,
				            );
				            $data->return_url = base_url().'razorpay/callback';
				            $data->surl = base_url().'success';;
				            $data->furl = base_url().'cancel';;
				            $data->currency_code = 'USD';
				            // Owner
				            $data->name = 'Orion Market Research Pvt. Ltd.';

				            $data->phone = $postData['contact_no'];
				            $data->email = $postData['email'];
				            $data->card_holder_name = $postData['name'];

				            $data->productinfo = $report->title;
							$data->txnid = time();
							// $data->return_url = base_url().'buy-now/'.$report->url;


				            $this->load->view('razorpay', $data);

						} else if ( $postData['payment_method'] == 'paypal' ) {
							$this->load->library('paypal_lib');
							// Add fields to paypal form
					        $this->paypal_lib->add_field('return', base_url().'success');
					        $this->paypal_lib->add_field('cancel_return', base_url().'cancel');
					        $this->paypal_lib->add_field('notify_url', base_url().'paypal/ipn');
					        $this->paypal_lib->add_field('item_name', $report->title);
					        $this->paypal_lib->add_field('item_number',  $report->report_code);
					        $this->paypal_lib->add_field('amount',  $postData['price']);
					        $this->paypal_lib->add_field('custom',  $request_id);

							// echo "<pre>";
							// print_r($this->paypal_lib);
							// echo "</pre>";

					        // Render paypal form
					        $this->paypal_lib->paypal_auto_form();
						}

					}


					$data->message->type = 'success';
					$data->message->content = 'Please wait, Redirecting to Paypal !';
				} else {
					$data->message->type = 'danger';
					$data->message->content = 'Something went wrong, please try again !';
					$this->load->view( 'header', $this->set_meta_and_title() );
					$this->load->view( 'buy_now', $data );
					$this->load->view( 'footer' );
				}
			}else{
				$this->load->view( 'header', $this->set_meta_and_title() );
				$this->load->view( 'buy_now', $data );
				$this->load->view( 'footer' );
			}

	        

		} else {
			$data->message->type = 'danger';
			$data->message->content = 'Report not found !';
			$this->load->view( 'header', $this->set_meta_and_title() );
			$this->load->view( 'buy_now', $data );
			$this->load->view( 'footer' );
		}

	}

	public function blogs($slug=null) {
		$this->load->model('Blog_model');
		$this->load->model('Report_model');

		$data = new stdClass();

		$data->blog_type_slug = strtolower($this->uri->segments[1]);
		$data->blog_type_name = ucwords(str_replace('-', ' ', $data->blog_type_slug));

		$meta = new stdClass();;
		if ( empty($slug) ) {
			$where = array(
			  	'order_by' => 'date_published',
			  	'sort' => 'desc',
			  	'status' => 1
			);
			switch ($data->blog_type_slug) {
				case 'blog':
					$where['type'] = 1;
					break;
				case 'news':
					// show all news, article and blogs
					// show only new if not commented
					// $where['type'] = 2;
					break;
				case 'press-release':
					$where['type'] = 3;
					break;
				
				default:
					$where['type'] = 1;
					break;
			}

			$blogs = $this->Blog_model->getBlogs($where);
			// if ( count($blogs) > 0 ) {
			// 	$data->blogs = $blogs->result;
			// }

			$meta->page_title = $data->blog_type_name . ' | Orion Market Research | OMR';

			$this->load->view( 'header', $meta );
			$this->load->view( 'blogs', $data );
			$this->load->view( 'footer' );
		}else{

			$data->blog_single = $this->Blog_model->getBlogBySlug($slug);

			if ( $data->blog_single ) {
				$where = array(
					'start' => 0,
					'limit' => 7,
				  	'order_by' => 'date_published',
				  	'sort' => 'desc',
				  	'status' => 1,
				  	'category' => $data->blog_single->category
				);

				$reports = $this->Report_model->getReports($where);
				if ( count($reports->result) > 0 ) {
					$data->related_reports = $reports->result;
				}

				$meta = $this->set_meta_and_title('report',$data->blog_single);
				if($data->blog_single && $data->blog_single->pr_status == 'noindex'){
					$meta->noindex = true;
				}
			}

			$this->load->view( 'header', $meta );
			$this->load->view( 'blog_single', $data );
			$this->load->view( 'footer' );
		}

	}

	public function is_user_logged_in(){
		$username = filter_input('session', 'username');
		$logged_in = filter_input('session', 'logged_in');
		if ( $username && $logged_in === true ) {
			return true;
		}
		return false;
	}

	public function send_mail( $email_to, $subject, $message, $email_from='info@omrglobal.com' ) { 
		if ( empty($email_from) ) {
			$email_from = 'info@omrglobal.com';
		}

		$this->load->library('email');
		$config = array(
			'protocol' => 'smtp',
		    'smtp_host' => 'ssl://mail.omrglobal.com',
		    'smtp_port' => 465,
        	'smtp_user' => 'info@omrglobal.com', // change it to yours
			'smtp_pass' => 'orion@ajm16', // change it to yours
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1',
        	'newline' => "\r\n",
        	'wordwrap' => TRUE,
		);

        $this->email->initialize($config);
		$this->email->from($email_from, 'Orion Market Research');
		$this->email->to($email_to);
		// $this->email->cc('mukati@omrglobal.com');
		$this->email->cc('vishal@omrglobal.com');
		$this->email->subject($subject);
		$this->email->message($message);
       
		// $this->email->send();
		if($this->email->send()) {
			return true;
		} else {
			return false;
		}
    }

    public function create_sitemap() {
        // Create sitemap reports and blogs
        $this->load->model('Blog_model');
		$this->load->model('Report_model');
		$this->load->model('Page_model');

		$data = new stdClass();
		$t_start = microtime(true);

        $links = array();
        $where = array(
		  	'order_by' => 'date_published',
		  	'sort' => 'desc',
		  	'status' => 1
		);

		$pages = $this->Page_model->getPages($where);
		$page_count = count($pages->result);
		if ( $page_count > 0 ) {
			foreach ( $pages->result as $item ) {
                $links[] = array('url'=>base_url().$item->url);
            }
		}

		$reports = $this->Report_model->getReports($where);
		$report_count = count($reports->result);
		if ( $report_count > 0 ) {
	        // Create the new sitemaps
            foreach ( $reports->result as $item ) {
                $links[] = array('url'=>base_url().'industry-reports/'.$item->url);
            }
		}

		$blogs = $this->Blog_model->getBlogs($where);
		$blog_count = count($blogs->result);
		$blog_links = array();
		if ( $blog_count > 0 ) {
			foreach ( $blogs->result as $item ) {
				if ( $item->type == 1 ) {
					// 1 Article
					$blog_links[] = array('url'=>base_url().'blog/'.$item->url);
				} else if ( $item->type == 2 ) {
					// 2 News
					$blog_links[] = array('url'=>base_url().'news/'.$item->url);
				} else if ( $item->type == 3 ) {
					// 3 Press-Release
					$blog_links[] = array('url'=>base_url().'press-release/'.$item->url);
				}
            }
		}
		sort($blog_links);

		$links = array_merge($links,$blog_links);

        $data->sitemap = $links;
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap",$data);
    }

}
