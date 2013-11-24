<?php
/* Vitamina: pone la racha a 0 */

/*
	Parametros disponibles
		$target_id 				-> id del usuario objetivo
		$CI->bitauth->user_id 	-> id del usuario logueado
*/

//grabar los puntos del target y opcionalmente los del usuario registrado
		$CI->bitauth->update_user(
			$target_id,
			array('racha'=>0)
			);
		