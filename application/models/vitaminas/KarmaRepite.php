<?php
/* Fichero de ejemplo de vitamina avanzada */

/* Esta vitamina ejecuta los efectos de la ultima vitamina que usó el target y los aplica a a si mismo*/

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

		$q = $this->db->query("select l.vitamina_id , v.fichero 
								from log l, vitamina v 
								where
		 						l.from_user_id = $target_id and 
		 						v.id = l.vitamina_id

		 						order by l.fecha desc limit 1");

		if ($q->num_rows()){
			$result = $q->result();
			$fichero = $result[0]->fichero;

			include($fichero);

		}