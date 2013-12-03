<?php
/* Fichero de ejemplo de vitamina avanzada */

/* pone a todos los miembros de un clan a la misma puntuación , que será la media de todo el clan	*/

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
			$familia = $this->db->query("select * from bitauth_userdata where clan = '$clan'");
			$primos = $familia->num_rows();

			$total = $this->db->query("select sum(puntos) total from bitauth_userdata where clan = '$clan'");
			$sumatotal = $total->results();

			$media = $sumatotal[0]->total / $primos;
			
			$this->db->query("update bitauth_userdata set puntos = $media where clan ='$clan'");

		} 
