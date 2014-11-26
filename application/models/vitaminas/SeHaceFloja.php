<?php
/* Fichero Se hace fuerte */

/* Esta vitamina le resta menos puntos cuanto menos tiempo quede para caducar
*/

/*
	Parametros disponibles
$target_id 					-> id del usuario objetivo
$CI->bitauth->user_id 		-> id del usuario logueado
*/

		//la vitamina cambia de dueño
	
		$getpoints = $this->db->query("select UNIX_TIMESTAMP(timeout)-UNIX_TIMESTAMP(NOW()) AS points from pastillero where id = $instancia_vitamina_id");

		$res = $getpoints->result();

		$coeficiente = intval($res[0]->points);



		$target = $CI->bitauth->get_user_by_id($target_id);
		$target_puntos = max($target->puntos - $coeficiente,0);
		$target_racha =  $target->racha;

//grabar los puntos del target y opcionalmente los del usuario registrado
		$CI->bitauth->update_user(
			$target_id,
			array('racha'=>$target_racha,
				'puntos'=>$target_puntos)
			);
