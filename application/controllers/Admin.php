<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handle admin functionalities
 * @author : DEarTh
 *
 */
class Admin extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->model('admin_model');
		
	}
	
	
	public function index() {
		if ( $this->isUserLoggedIn() ) {
			redirect( 'admin/dashboard' );
		}
		$this->load->helper('form');
		// $this->load->view('admin/header');
		$this->load->view('admin/login');
		// $this->load->view('admin/footer');
		
	}

	public function dashboard() {

		if ( ! $this->isUserLoggedIn() ){
			redirect( 'admin/login' );
		}

		$data = new stdClass();
		$user_id = $_SESSION['user_id'];
		$data->user = $this->admin_model->getUser($user_id);
		if ($_SESSION['is_admin'] == 1) {
			$this->load->view('admin/header',['title'=>'Dashboard']);
			$this->load->view('admin/dashboard',$data);
			$this->load->view('admin/footer');
		}else {
			$this->load->view('admin/user_header',['title'=>'Dashboard']);
			$this->load->view('admin/dashboard',$data);
			$this->load->view('admin/footer');
		}
		
		
	}
	
	public function register() {

		// disable so redirect to dashboard
		redirect( 'admin/dashboard' );
		if ( $this->isUserLoggedIn() ) {
			redirect( 'admin/dashboard' );
		}

		$data = new stdClass();
		
		// load helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[rp_users.username]', array('is_unique' => 'This username already exists, try another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[rp_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() !== false) {
			
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->admin_model->createUser($username, $email, $password)) {
				
				redirect('admin/dashboard');

			} else {

				// user registation failed
				$data->error = 'There was a problem creating your new account. Please try again.';

			}
		}
		// send errors/data to the view
		$this->load->view('admin/register', $data);
		
	}

	public function change_password() {

		if ( ! $this->isUserLoggedIn() ){
			redirect( 'admin/login' );
		}

		$data = new stdClass();
		$data->message = new stdClass();
		
		// load helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]');
		
		if ($this->form_validation->run() !== false) {
			
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');
			
			if ($this->admin_model->updatePassword($old_password, $new_password)) {
				
				$data->message->type = 'success';
				$data->message->content = 'Password updated successfully !';

			} else {

				$data->message->type = 'danger';
				$data->message->content = 'Incorrect Old Password';

			}
		}
		// send errors/data to the view
		$this->load->view('admin/header',['title'=>'Reset Password']);
		$this->load->view('admin/change_password', $data);
		$this->load->view('admin/footer');
		
	}
	public function reset_password_ajax() {

		$response = new stdClass();
		$email_to = $this->input->post('email');

		$new_password = $this->admin_model->resetPassword($email_to);
		if ( $new_password ) {
			$subject 		= 'Reset Password : OMR Global';
			$message = 'Your new password is : <br>
						Password : '.$new_password.'<br>
						Message : Please use this password to login to your account.';
			$email_from = 'info@omrglobal.com';
			$this->send_mail( $email_to, $subject, $message, $email_from );

			$response->status = 'success';
			$response->msg = 'Password successfully sent, please check your mail !';
		} else {
			$response->status = 'error';
			$response->msg = 'Email is not registered , please try again !';
		}
		echo json_encode($response);
	}
		
	public function login() {

		if ( $this->isUserLoggedIn() ) {
			redirect( 'admin/dashboard' );
		}
		$data = new stdClass();
		
		// load helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() !== false) {
			
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->admin_model->resolveUserLogin($email, $password)) {
				
				$user_id = $this->admin_model->getUserIdFromEmail($email);
				$user    = $this->admin_model->getUser($user_id);
				
				// set session
				$_SESSION['user_id']    = (int)$user->id;
				$_SESSION['username']   = (string)$user->username;
				$_SESSION['email']   	= (string)$user->email;
				$_SESSION['logged_in']  = (bool)true;
				$_SESSION['status'] 	= (int)$user->status;
				$_SESSION['is_admin']   = (int)$user->is_admin;
				
				// user logged in
				redirect('admin/dashboard');
				
			} else {

				// login failed
				$data->error = 'Wrong Email or password.';
			}
			
		}
		// send errors/data to the view
		// $this->load->view('header');
		$this->load->view('admin/login', $data);
		// $this->load->view('footer');
		
	}
	
	public function logout() {
		
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session data
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
		}
		redirect('admin/login');
		
	}

	static function isUserLoggedIn($redirect=false){

		$return = ( isset($_SESSION['username']) && isset($_SESSION['logged_in']) ) ? true : false;

		if ( $redirect === true && !$return) {
			redirect( 'admin/login' );
		}else{
			return $return;
		}

	}

	public function send_mail( $email_to, $subject, $message, $email_from ) { 
		if ( empty($email_from) ) {
			$email_from = 'info@omrglobal.com';
		}

		$this->load->library('email');
		$config = array(
			'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
        	'smtp_user' => 'dearth22686@gmail.com', // change it to yours
			'smtp_pass' => 'BeTheWinner#22686', // change it to yours
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1',
        	'newline' => "\r\n",
        	'wordwrap' => TRUE,
		);

        $this->email->initialize($config);
		$this->email->from($email_from, 'Orion Market Research');
		$this->email->to($email_to);
		$this->email->cc('infophp19@gmail.com');
		$this->email->subject($subject);
		$this->email->message($message);

		// $this->email->send();
		if($this->email->send()) {
			//echo 'Mail sent';
			return true;
		} else {
			//show_error($this->email->print_debugger());
			return false;
		}
    }
	
}
