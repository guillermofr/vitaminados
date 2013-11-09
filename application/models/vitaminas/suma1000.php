<?php
		$own = $CI->bitauth->get_user_by_id($CI->bitauth->user_id);
		$own_puntos = $own->puntos;
		$own_racha = $own->racha;

		$target = $CI->bitauth->get_user_by_id($target_id);
		$target_puntos = $target->puntos +1000;
		$target_racha =  $target->racha;

		//manipular racha o puntos

		$CI->bitauth->update_user(
					$target_id,
					array('racha'=>$target_racha,
						  'puntos'=>$target_puntos)
				);
		/* 
		// si fuera necesario efectos secundarios
		$CI->bitauth->update_user(
					$own->user_id,
					array('racha'=>$own_racha,
						  'puntos'=>$own_puntos)
				);
		*/