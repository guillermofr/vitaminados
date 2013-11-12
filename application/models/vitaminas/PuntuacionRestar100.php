<?php
/* Vitamina: Resta 100 puntos al objetivo */

/*
	Parametros disponibles
		$target_id 				-> id del usuario objetivo
		$CI->bitauth->user_id 	-> id del usuario logueado
*/

//obtener datos del usuario logueado

		$own = $CI->bitauth->get_user_by_id($CI->bitauth->user_id);
		$own_puntos = $own->puntos;
		$own_racha = $own->racha;

//obtener datos del usuario target

		$target = $CI->bitauth->get_user_by_id($target_id);
		$target_puntos = max(0,$target->puntos-100);
		$target_racha =  $target->racha;

//manipular racha o puntos al gusto


//grabar los puntos del target y opcionalmente los del usuario registrado
		$CI->bitauth->update_user(
					$target_id,
					array('racha'=>$target_racha,
						  'puntos'=>$target_puntos)
				);
	