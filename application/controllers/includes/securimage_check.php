<?php

	$this->load->helper('securimage/securimage');
	$image = new Securimage();
    if ($image->check($this->input->post('captcha_code')) == true) {
      $captchacorrecto = true;
    } else {
      $captchacorrecto = false;
    }

?>