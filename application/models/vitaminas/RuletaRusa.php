<?php
/* Vitamina: Uno de los dos vuelve a empezar */

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
		$target_puntos = $target->puntos;
		$target_racha =  $target->racha;

// Juguemos a la ruleta rusa
		$disparo = rand(0,1);
		// Te disparas a ti mismo
		if ($disparo == 0){
			$own_puntos = 0;
			$own_racha = 0;

			$CI->bitauth->update_user(
				$own->user_id,
				array('racha'=>$own_racha,
					'puntos'=>$own_puntos)
				);
		}

		// NOT TODAY!!
		else {
			$target_puntos=0;
			$target_racha =0;

			$CI->bitauth->update_user(
				$target_id,
				array('racha'=>$target_racha,
					'puntos'=>$target_puntos)
				);

		}
