<?php
/* Fichero de ejemplo de vitamina avanzada */

/* Suma 100 puntos a todos los compañeros de clan del objetivo	*/

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
			$this->db->query(" update bitauth_userdata set puntos = puntos + 100 where clan == '$clan' ");
		}
