<?php
/* Fichero de ejemplo de vitamina avanzada */

/* resta 1000 al objetivo por cada miembro de tu clan que esté jugando	*/

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

		


//manipular racha o puntos al gusto

		if ($own->clan != ''){
			$clan = $own->clan;
			$familia = $this->db->query("select * from bitauth_userdata where clan = '$clan'");
			$primos = $familia->num_rows();
			$target = $CI->bitauth->get_user_by_id($target_id);
			$target_puntos = max(0,$target->puntos - ($primos * 1000));
			$target_racha =  $target->racha;

			$CI->bitauth->update_user(
				$target_id,
				array('racha'=>$target_racha,
					  'puntos'=>$target_puntos)
			);

		} else {
			$CI->bitauth->update_user(
				$target_id,
				array('racha'=>$target_racha,
					  'puntos'=>max(0,$target_puntos - 1000))
			);
		}
