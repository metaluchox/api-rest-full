<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Auth extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->helper('auth');
	}
	
	public function index_get(){	
			$token = $this->uri->segment(3);

			if(!isset($token)){
				$response = help_generate_resp(true, 'falta parametro', null);

				$this->response( $response, REST_Controller:: HTTP_BAD_REQUEST );
			}

			if(isset($token)){
				$exists_auth = $this->Auth_model->get_auth($token);
				if($exists_auth){
					$response = help_generate_resp(false, 'existe', $exists_auth);
					$this->response( $response, REST_Controller:: HTTP_OK );
				}else{
					$response = help_generate_resp(false, 'no existe', $exists_auth);
					$this->response( $response, REST_Controller:: HTTP_NOT_FOUND );
				}
				
		
				
			}

	}

	public function create_put(){
			$data = $this->put();

			$this->load->library('form_validation');
			$this->form_validation->set_data($data);

			if($this->form_validation->run('auth_put')){

				$this->Auth_model->insert($data);
				$response = help_generate_resp(false, 'OK', null);
				$this->response($response, REST_Controller:: HTTP_OK);

			}else{

				$response = help_generate_resp(true, 'Hay errores en la creacion del token', $this->form_validation->get_errores_arreglo());
				$this->response($response, REST_Controller:: HTTP_BAD_REQUEST);
			}

	}

	public function delete_put($token){
		$this->Auth_model->delete($token);
		$response = help_generate_resp(false, 'auth borrado', null);
		$this->response( $response, REST_Controller:: HTTP_OK );
	}	

}