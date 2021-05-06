<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model {


	public function __construct(){
		parent::__construct();
		$this->load->database();

	}


	public function get_auth ($token){
		$response = false;

			$this->db->where("token", $token);
			$this->db->limit(1);
			$this->db->from('keys');

			if($this->db->count_all_results()>0){
				$response = true;
			}

		return $response;
	}

	function insert($data){
		$this->db->insert("keys", $data);
	}

	function delete($token){

		$this->db->where('token', $token);
		$this->db->delete('keys');
	}	



}