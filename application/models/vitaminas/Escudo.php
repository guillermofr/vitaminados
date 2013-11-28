<?php
/* Fichero de ejemplo de vitamina pasiva */

/* Esta vitamina tiene dos códigos, en este fichero se define la acción de usar 
	- al usarse se le pasa esta vitamina a otra persona
	El otro efecto se configura a la hora de aplicar la vitamina, ya que si el usuario
	tiene alguna vitamina de este tipo en su pastillero, la vitamina se gastará al recibir
	algun ataque y no se realizarán los daños del atacante.
*/

/*
	Parametros disponibles
$target_id 					-> id del usuario objetivo
$CI->bitauth->user_id 		-> id del usuario logueado
*/

		//la vitamina cambia de dueño
		$this->db->query("update pastillero set user_id = $target_id where id = $instancia_vitamina_id ");

		// esto hace que no se anule la vitamina despues de usarse
		$instancia_vitamina_id = 0; 