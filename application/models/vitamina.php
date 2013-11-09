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

		//buscamos las vitaminas de dicha categoría y las contamos
			$vitaminas = $this->db->query("select * from vitamina where categoria = $categoria");
			$num_vitaminas = $vitaminas->num_rows();
			$res_vitaminas = $vitaminas->result_array();
		
		//hacemos un random para seleccionar una
			$random = rand(0,$num_vitaminas-1);

			$vitamina_id = $res_vitaminas[$random]['id'];
			$timeout = 	 $res_vitaminas[$random]['time'];

		$user_id = $this->bitauth->user_id;

		$this->db->query("insert into 
			pastillero(vitamina_id,user_id,timeout) 
			values($vitamina_id,$user_id,DATE_ADD(NOW(), INTERVAL $timeout MINUTE))");

	}

	function get_listado(){
		$result = $this->db->query("select * from vitamina order by categoria asc");
		return $result->result();
	}

	function get_vitaminas(){
		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;

		$user_id = $CI->bitauth->user_id;
		$result = $this->db->query("select p.id instancia, p.vitamina_id, p.timeout, v.nombre, v.descripcion, v.categoria from pastillero p, vitamina v
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



	function vitamina_usable($instancia_vitamina_id){
		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;

		$q = $this->db->query("select * from pastillero where id = $instancia_vitamina_id and user_id = ". $CI->bitauth->user_id . " and timeout > NOW() ");
		
		if ($q->num_rows()){
			return true;
		} else {
			return false;
		}
		

	}


	function usar($instancia_vitamina_id,$target_id){
		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;

		// sacamos el tipo y el fichero de vitamina a $instancia_vitamina_id

		$query = $this->db->query("select v.fichero,v.id
						from vitamina v, pastillero p 
						where
							p.vitamina_id = v.id and 
							p.id = $instancia_vitamina_id and
							p.timeout > NOW()");
		// hacemos include del código respectivo, rutas vitaminas/code
		$q = $query->result();

		if ($query->num_rows()){
			include('vitaminas/'.$q[0]->fichero);
			//deshabilitar
			$this->db->query("update pastillero set timeout = 0 where id= $instancia_vitamina_id");
			//meterlo en el log
			$this->db->query("insert into log (from_user_id,to_user_id,vitamina_id,fecha) values ("
				.$CI->bitauth->user_id.","
				.$target_id.","
				.$q[0]->id.",NOW())");
		} 
	}

}