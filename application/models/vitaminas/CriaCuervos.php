<?php
/* Fichero de ejemplo de vitamina avanzada */

/* resta le das 2k puntos a cada uno de tus compañeros de clan	*/

/*
	Parametros disponibles
	$target_id 					-> id del usuario objetivo
	$CI->bitauth->user_id 		-> id del usuario logueado
*/

//obtener datos del usuario logueado

		$own = $CI->bitauth->get_user_by_id($CI->bitauth->user_id);
		$own_puntos = $own->puntos;
		$own_racha = $own->racha;

//obtener datos del usuario target

		$target = $CI->bitauth->get_user_by_id($target_id);
		$target_puntos = $target->puntos;
		$target_racha =  $target->racha;


//manipular racha o puntos al gusto

		if ($target->clan != ''){
			$clan = $target->clan;
			$familia = $this->db->query("select * from bitauth_userdata where clan = '$clan'");
			$primos = $familia->num_rows();
			
			$this->db->query("update bitauth_userdata set puntos = puntos + 2000 where clan ='$clan' and user_id != $target_id");

			$CI->bitauth->update_user(
				$target_id,
				array('racha'=>$target_racha,
					  'puntos'=>max(0,$target_puntos - ($primos *2000)))
			);

		} 
