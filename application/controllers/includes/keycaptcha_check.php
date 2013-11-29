
<?php 

	if (!class_exists('KeyCAPTCHA_CLASS')) {
		$this->load->helper('keycaptcha/keycaptcha');
	}
	$kc_o = new KeyCAPTCHA_CLASS();
	if ($kc_o->check_result($_POST['capcode'])) {
		$captchacorrecto = true;
	}
	else {
		$captchacorrecto = false;
	}
?>