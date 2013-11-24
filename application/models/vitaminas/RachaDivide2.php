<?php
/* Vitamina: Divide la racha por 2 */

/*
	Parametros disponibles
		$target_id 				-> id del usuario objetivo
		$CI->bitauth->user_id 	-> id del usuario logueado
*/

//grabar los puntos del target y opcionalmente los del usuario registrado
		$CI->bitauth->update_user(
			$target_id,
			array('racha'=>$target_racha/2,
				)
			);
