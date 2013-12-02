
<?php 

	$this->load->helper('minteye/adscaptchalib');
	$captchaId  = '5869';   // Set your captcha id here
	$privateKey = '8f449f0f-1da6-4624-ad3c-43762f842b37';   // Set your private key here
	$challengeValue = $_POST['adscaptcha_challenge_field'];
	$responseValue  = $_POST['adscaptcha_response_field'];
	$remoteAddress  = $_SERVER["REMOTE_ADDR"];

	if ("true" == ValidateCaptcha($captchaId, $privateKey, $challengeValue, $responseValue, $remoteAddress))
	{
	    $captchacorrecto = true;
	} else {
	    $captchacorrecto = false;
	}

?>