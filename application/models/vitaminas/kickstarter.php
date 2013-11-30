<?php
/* Fichero de ejemplo de vitamina avanzada */

/* resta 1000 puntos a todos los compañeros de clan del objetivo	*/

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

		$count = $this->db->query("select * from bitauth_userdata where puntos > 1000");
		$this->db->query("update bitauth_userdata set puntos = puntos - 1000 where puntos > 1000");
		
		if ($count->num_rows()) {
			$count_ = $count->num_rows();
			$this->db->query("update bitauth_userdata set puntos = puntos + ".$count_."000 where user_id = $target_id");
		}
		
