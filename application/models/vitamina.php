<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'../sparks/MY_Model/1.0.0/core/MY_Model.php');
//info https://github.com/Se7en-IT/Base-Model-Codeigniter
class Vitamina extends MY_Model{

	function __construct()
	{
		parent::__construct();
	}
	
	function crear_nueva($categoria = 1){

		// segun la categoría que venga seleccionaremos por random una vitamina

		/*
		categorías 
			1º categoria <- megasuper x500
			2º categoria <- super x50
			3º categoria <- normales x10
		*/

		$vitamina_id = 1;
		$timeout = 60;   	

		$user_id = $this->bitauth->user_id;

		$this->db->query("insert into 
			pastillero(vitamina_id,user_id,timeout) 
			values($vitamina_id,$user_id,DATE_ADD(NOW(), INTERVAL $timeout MINUTE))");

	}

	function get_vitaminas(){
		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;

		$user_id = $CI->bitauth->user_id;
		$result = $this->db->query("select p.id instancia, p.vitamina_id, p.timeout, v.nombre, v.descripcion from pastillero p, vitamina v
			where
			 p.vitamina_id = v.id and 
			 user_id = $user_id and timeout > NOW()");

		return $result->result();
	}

	function get_vitamina_desc($id){
		$result = $this->db->query("select v.descripcion from vitamina v
			where id = $id " );

		$temp = $result->result();
		if ($result->num_rows())
			return $temp[0]->descripcion;
	}

	function usar_vitamina($vitamina_id){
		
	}

}