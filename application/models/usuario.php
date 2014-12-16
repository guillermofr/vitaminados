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
	function juego_empezado(){

	    $q = $this->db->query('select * from vars where id = 1 and inicio < now()');
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
		if (!$this->bitauth->logged_in()) return false;

		$this->bitauth->update_user(
					$this->bitauth->user_id,
					array('racha'=>$this->bitauth->racha + 1,
						  'puntos'=>$this->bitauth->puntos + ($this->bitauth->racha +1 )* 10 )
				);
	}

	function get_targets(){

		$this->load->add_package_path(APPPATH.'third_party/bitauth/');
		$this->load->library('bitauth');
		if (!$this->bitauth->logged_in() ) return array();
	
		$user = $this->bitauth->get_user_by_username($this->bitauth->username);
		$user = $user->user_id;
		
		/*$res = $this->db->query("select *,user_id as id1,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.categoria = 1 and
				user_id = id1 and timeout > NOW()) as red,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.categoria = 2 and
				user_id = id1 and timeout > NOW()) as yellow,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.categoria = 3 and
				user_id = id1 and timeout > NOW()) as green,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.fichero = 'Escudo.php' and
				user_id = id1 and timeout > NOW()) as shields

	from bitauth_userdata where user_id != $user and fullname != '' order by puntos desc");*/

		$res = $this->db->query("select *,user_id as id1,
	0 as red,
	0 as yellow,
	0 as green,
	0 as shields

	from bitauth_userdata where user_id != $user and fullname != '' order by puntos desc");


		return $res->result();	
	}

	function get_rank($user_id){

		//$q = $this->db->query("select count(1) rank from bitauth_userdata where fullname != '' and puntos > (select puntos from bitauth_userdata where user_id = $user_id) group by puntos,fullname order by puntos,racha");

		$this->db->query("SET @rowno = 0;");
		$q = $this->db->query("
				select rn as rank from (select *,@rowno:=@rowno+1 `rn` from bitauth_userdata bu where fullname != '' order by bu.puntos desc, bu.racha desc) as sub
				where user_id = $user_id");
		$res = $q->result();

		if ($q->num_rows())
		return $res[0]->rank . "#";
		else 
		return "-";
	}

	function get_ranking(){
	/*$res = $this->db->query("select *,user_id as id1,

			(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.categoria = 1 and
				user_id = id1 and timeout > NOW()) as red,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.categoria = 2 and
				user_id = id1 and timeout > NOW()) as yellow,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.categoria = 3 and
				user_id = id1 and timeout > NOW()) as green,
	(select count(*)
			from 
				pastillero p, vitamina v
			where
				p.vitamina_id = v.id and 
				v.fichero = 'Escudo.php' and
				user_id = id1 and timeout > NOW()) as shields


			from bitauth_userdata where fullname != '' order by puntos desc, racha desc");*/


		$res = $this->db->query("select *,user_id as id1,

			0 as red,
			0 as yellow,
			0 as green,
			0 as shields


			from bitauth_userdata where fullname != '' order by puntos desc, racha desc");
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

	function get_fechainicio(){
		$q = $this->db->query("select inicio from vars order by id desc limit 1");
		return $q->result();
	}

	function get_hora_servidor(){
		$q = $this->db->query("select now() as ahora");
		$r = $q->result();
		$date = date_parse($r[0]->ahora); 
		return (($date['hour']<10)?'0'.$date['hour']:$date['hour']).":".(($date['minute']<10)?'0'.$date['minute']:$date['minute']).":".(($date['second']<10)?'0'.$date['second']:$date['second']);
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

	function get_last_ataques(){
		$q = $this->db->query("select v.nombre vitamina , v.id vitamina_id , l.fecha	,l.to_user_id,l.from_user_id, bat.fullname tofull, baf.fullname fromfull
								from 
									log l
								INNER JOIN vitamina v ON v.id = l.vitamina_id
								LEFT JOIN bitauth_userdata bat ON bat.user_id = `l`.`to_user_id`
								LEFT JOIN bitauth_userdata baf ON baf.user_id = `l`.`from_user_id` 
								order by 
									l.fecha desc
								limit 
									250");
		return $q->result();
	}

	function get_first_id() {
		$q = $this->db->query("select user_id from bitauth_userdata order by puntos desc limit 1");
		$res = $q->result();
		return $res[0]->user_id;
	}
	

}