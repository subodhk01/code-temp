<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handle database functions
 * @author : DEarTh
 */
class Admin_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		
	}

	protected function generateSalt() {
            $salt = "xiORG17N6ayoEn6X3";
            return $salt;
    }
	
	/**
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function createUser($username, $email, $password) {
		
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'password'   => $this->hashPassword($this->generateSalt().$password),
			'status'     => 1,
			'is_admin'   => 1,
			'created_at' => date('Y-m-j H:i:s'),
			'modified_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('rp_users', $data);
		
	}

	public function updatePassword($old_password, $new_password) {

		$email = $_SESSION['email'];
		$this->db->select('password,id');
		$this->db->from('rp_users');
		$this->db->where('email', $email);
		$user = $this->db->get()->row();

		if ( $this->verifyPasswordHash($this->generateSalt().$old_password, $user->password) ){
			$data = array(
				'password'   => $this->hashPassword($this->generateSalt().$new_password),
				'modified_at' => date('Y-m-j H:i:s'),
			);

			$this->db->where('id', $user->id);
			return $this->db->update('rp_users', $data);
		}
		
		return false;
		
	}

	public function resetPassword($email) {

		$this->db->select('email');
		$this->db->from('rp_users');
		$this->db->where('email', $email);
		$user = $this->db->get()->row();

		if ( $user ) {
			$new_password = $this->generateRandomPassword(8);
			$data = array(
				'password'   => $this->hashPassword($this->generateSalt().$new_password),
				'modified_at' => date('Y-m-j H:i:s'),
			);
			

			$this->db->where('email', $email);
			$this->db->update('rp_users', $data);
			if ( $this->db->update('rp_users', $data) ) {
				return $new_password;
			}
		}
		return false;

	}

	public function generateRandomPassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
	
	/**
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolveUserLogin($email, $password) {
		
		$this->db->select('password');
		$this->db->from('rp_users');
		$this->db->where('email', $email);
		$hash = $this->db->get()->row('password');
		
		return $this->verifyPasswordHash($this->generateSalt().$password, $hash);
		
	}
	
	/**
	 * @param mixed $username
	 * @return int user_id
	 */
	public function getUserIdFromEmail($email) {
		
		$this->db->select('id');
		$this->db->from('rp_users');
		$this->db->where('email', $email);

		return $this->db->get()->row('id');
		
	}
	
	/**
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function getUser($user_id) {
		
		$this->db->from('rp_users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * @param mixed $password
	 * @return string|bool success, or bool false on failure
	 */
	private function hashPassword($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verifyPasswordHash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}
	
}
