<?php

	if ($this->input->post('resultado')){
		if ($this->input->post('resultado') == 2){
	  		$captchacorrecto = true;
		}else {
	  		$captchacorrecto = false;	
		}
	} else {
		$captchacorrecto = false;
	}
?>