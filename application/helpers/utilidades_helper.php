<?php

	function esNumerico ($valor){
		$respuesta = "";
		if (!is_numeric($valor)) {
			$respuesta = array('err' => true, 'msj' => 'el id tiene que ser numerico');			
		}
		
		return $respuesta;
	}


	
?>