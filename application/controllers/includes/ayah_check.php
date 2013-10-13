<?php
	$this->load->helper('ayah/ayah');
	$ayah = new AYAH();

    $score = $ayah->scoreResult();
    if ($score)
    {
        $captchacorrecto = true;
    }
    else
    {
        $captchacorrecto = false;
    }
?>