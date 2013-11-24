<?php
/* Fichero de ejemplo de vitamina avanzada */

/* Esta vitamina Borra 2 vitaminas de tu adversario */

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


		$this->db->query("delete from pastillero where user_id = $target_id order by timeout desc limit 2");

