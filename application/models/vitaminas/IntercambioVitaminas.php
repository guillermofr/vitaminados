<?php
/* Fichero de ejemplo de vitamina avanzada */

/*Esta vitamina intercambia las vitaminas del inventario del objetivo con las tuyas*/

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

		$this->db->query("update pastillero set user_id = '" . $own->user_id. "_" .$target_id . "' where user_id = $target_id ");
		$this->db->query("update pastillero set user_id = $target_id where user_id = ".$own->user_id);
		$this->db->query("update pastillero set user_id = ".$own->user_id." where user_id = '" . $own->user_id. "_" .$target_id . "'");
