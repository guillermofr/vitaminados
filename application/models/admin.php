<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'../sparks/MY_Model/1.0.0/core/MY_Model.php');
//info https://github.com/Se7en-IT/Base-Model-Codeigniter
class Admin extends MY_Model{

	function __construct()
	{
		parent::__construct();
	}
	
	function save_vitamina($data){

		if (isset($data['id'])) {
			//edita vitamina existente

			$this->db->where('id', $data['id']);
			$this->db->update('vitamina', $data); 

		} else {
			//crea una vitamina nueva

			$this->db->insert('vitamina', $data); 

		}

	}

	function save_fechas($data){
		if (isset($data['id'])) {
			//edita vitamina existente

			$this->db->where('id', $data['id']);
			$this->db->update('vars', $data); 

		} else {
			//crea una vitamina nueva

			$this->db->insert('vars', $data); 

		}
	}

	function get_vars(){
		$data = $this->db->get('vars'); 
		return $data->result_array();
	}

}