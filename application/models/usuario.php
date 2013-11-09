<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'../sparks/MY_Model/1.0.0/core/MY_Model.php');
//info https://github.com/Se7en-IT/Base-Model-Codeigniter
class Usuario extends MY_Model{

	function __construct()
	{
		parent::__construct();
	}
	

	function reset_racha(){
		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;

		$CI->bitauth->update_user(
						$CI->bitauth->user_id,
						array('racha'=>0)
					);
	}

	function aumenta_puntuacion(){
		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;

		$CI->bitauth->update_user(
					$CI->bitauth->user_id,
					array('racha'=>$CI->bitauth->racha + 1,
						  'puntos'=>$CI->bitauth->puntos + $CI->bitauth->racha + 1 )
				);
	}

	function get_targets(){

		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
		if (!$CI->bitauth->logged_in()) return false;
	
		$user = $CI->bitauth->get_user_by_username($CI->bitauth->username);
		$user = $user->user_id;
		
		$res = $this->db->query("select * from bitauth_userdata where user_id != $user order by puntos");
		return $res->result();	
	}



	

	
}