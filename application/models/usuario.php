<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'../sparks/MY_Model/1.0.0/core/MY_Model.php');
//info https://github.com/Se7en-IT/Base-Model-Codeigniter
class Usuario extends MY_Model{

	function __construct()
	{
		parent::__construct();
	}
	
	function juego_terminado(){

	    $q = $this->db->query('select * from vars where id = 1 and fin < now()');
	    return $q->num_rows();

	}

	function get_usuario($user_id){
		$q = $this->db->query("select * from bitauth_userdata where user_id = $user_id");
	    return $q->result();
	}

	function reset_racha(){
		$this->load->add_package_path(APPPATH.'third_party/bitauth/');
		$this->load->library('bitauth');
		if (!$this->bitauth->logged_in()) return false;

		$this->bitauth->update_user(
						$this->bitauth->user_id,
						array('racha'=>0)
					);
	}

	function aumenta_puntuacion(){
		$this->load->add_package_path(APPPATH.'third_party/bitauth/');
		$this->load->library('bitauth');
		if (!$this->bitauth->logged_in() || $this->juego_terminado()) return false;

		$this->bitauth->update_user(
					$this->bitauth->user_id,
					array('racha'=>$this->bitauth->racha + 1,
						  'puntos'=>$this->bitauth->puntos + $this->bitauth->racha + 1 )
				);
	}

	function get_targets(){

		$this->load->add_package_path(APPPATH.'third_party/bitauth/');
		$this->load->library('bitauth');
		if (!$this->bitauth->logged_in()  || $this->juego_terminado() ) return array();
	
		$user = $this->bitauth->get_user_by_username($this->bitauth->username);
		$user = $user->user_id;
		
		$res = $this->db->query("select * from bitauth_userdata where user_id != $user and fullname != '' order by puntos desc");
		return $res->result();	
	}

	function get_rank($user_id){

		$q = $this->db->query("select count(1) rank from bitauth_userdata where fullname != '' and puntos > (select puntos from bitauth_userdata where user_id = $user_id) group by puntos");

		return $q->num_rows() +1 . "#";
	}

	function get_ranking(){

		$res = $this->db->query("select * from bitauth_userdata where fullname != '' order by puntos desc");
		return $res->result();	
	}

	function get_ganadores(){

		$res = $this->db->query("select * from bitauth_userdata where fullname != '' and participante = 1 order by puntos desc limit 2");
		return $res->result();	
	}

	function target_usable($target_id){
		$q = $this->db->query("select * from bitauth_userdata where user_id = $target_id");
		return $q->num_rows();
	}

	function get_fechafin(){
		$q = $this->db->query("select fin , (NOW() > fin) terminada from vars order by id desc limit 1");
		return $q->result();
	}

	function get_ataques($user_id){
		$q = $this->db->query("select v.nombre vitamina , v.id vitamina_id , u.fullname quien , u.user_id quien_id , l.fecha 
								from 
									log l, 
									bitauth_userdata u, 
									vitamina v 
								where 
									l.vitamina_id = v.id and
									u.user_id = l.from_user_id and
									l.to_user_id = $user_id and
									l.from_user_id != $user_id
								order by 
									fecha desc
								limit 
									5");
		return $q->result();
	}
	

	
}