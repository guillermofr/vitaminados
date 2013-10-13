<?php

	$this->load->helper('recaptcha/recaptchalib');
	$privkey = "6Le4k-gSAAAAANIdExCmaoHeBPU4-mb1baMElBQc"; // Private API Key
	$verify = recaptcha_check_answer($privkey, $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

	if ($verify->is_valid) {
	  $captchacorrecto = true;
	}
	else {
	  $captchacorrecto = false;
	}
	
?>