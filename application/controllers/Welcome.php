<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Welcome extends REST_Controller {

	public function __construct(){
		parent::__construct();
	}


public function uploadImageToCloudinary_put(){

	$data = $this->put();
	$path  =  'C:\imagen\foto.jpg'; 

	file_put_contents ( $path ,  file_get_contents ( $data['imagen'] ));	

	$this->response($data['imagen'], REST_Controller:: HTTP_OK);


}

}