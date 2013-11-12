<?php

	if ($this->input->post('resultado')){
		if ($this->input->post('resultado') == $this->session->userdata('simple_check')){
	  		$captchacorrecto = true;
		}else {
	  		$captchacorrecto = false;	
		}
	} else {
		$captchacorrecto = false;
	}
?>