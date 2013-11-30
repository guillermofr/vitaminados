<?php
/* Fichero de ejemplo de vitamina avanzada */

/*esta vitamina genera 5 vitaminas normales*/

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

		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);		
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
		$this->crear_nueva(3,$target_id);
