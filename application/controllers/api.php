<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
        parent::__construct();
        $this->load->spark('twiggy/0.8.5');

    }

    function load_vitamina_desc($id = 0){

    	$this->load->model('vitamina');

    	if ($id) {
    		echo $this->vitamina->get_vitamina_desc($id);
    	} else 
    		echo "descripcion no encontrada";

    }
   

   	function load_targets(){

   		$this->load->model('usuario');
   		$CI = & get_instance();
		$CI->load->add_package_path(APPPATH.'third_party/bitauth/');
		$CI->load->library('bitauth');
    if (!$CI->bitauth->logged_in()) return false;

   		$usuarios = $this->usuario->get_targets();

   		$html = '<p>Tu</p>';

      $clancolor = ($CI->bitauth->clan != null)?"#".substr(md5($CI->bitauth->clan),0,6):'#ffffff';

      $html .= "<div class='target'>
          <input type='hidden' name='id' value='".$CI->bitauth->user_id."'/>
          <img class='target-img' style='border-color:$clancolor' src='http://1.gravatar.com/avatar/".$CI->bitauth->user_id."?s=50&d=monsterid&r=G' />
          <span class='target-nick'>".recortar_texto($CI->bitauth->fullname,10)."</span>
          <span class='target-puntos'>".$CI->bitauth->puntos."</span>
          <span class='target-racha'>combo<br>x".$CI->bitauth->racha."</span>
        </div>";

   		$html .= '<p>Los demás</p>';
   		
   		//for ($i = 0 ; $i<14 ;$i++) 
   		foreach ($usuarios as $u) {

        if ($u->participante) {
          $participante = 'participante';
          $logo = "<img title='Participante' class='target-logo' src='http://www.murcialanparty.com/mlp13/nimagenes/logo.png' />";
        } else {
          $participante = '';
          $logo = "";
        }

       $clancolor = ($u->clan != null)?"#".substr(md5($u->clan),0,6):'#ffffff';


   			$html .= "<div class='target ".$participante."'>
   				<input type='hidden' name='id' value='".$u->user_id."'/>
   				<img class='target-img' style='border-color:$clancolor' src='http://1.gravatar.com/avatar/".$u->user_id."?s=50&d=monsterid&r=G' />
   				<span class='target-nick'>".recortar_texto($u->fullname,10)."</span>
   				<span class='target-puntos'>".$u->puntos."</span>
   				<span class='target-racha'>combo<br>x".$u->racha."</span>
          ".$logo."
   			</div>";
   		}

   		$html .= "<br clear='left'/><button class='md-cancel'>Cancelar</button>";

   		echo $html;

   	}


    function load_ranking($user_id = 0,$selected = 0){

      $this->load->model('usuario');

      $usuarios = $this->usuario->get_ranking();

      $html = '<p>Lista de usuarios</p><div style="margin:auto">';

      $rank = 1;


      //for ($i = 0 ; $i<14 ;$i++) 
      foreach ($usuarios as $u) {
        if ($u->participante) {
          $participante = 'participante';
          $logo = "<img title='Participante' class='rank-logo' src='http://www.murcialanparty.com/mlp13/nimagenes/logo.png' />";
        } else {
          $participante = '';
          $logo = "";
        }

        $class = "";
        if ($user_id == $u->user_id){
          $class .= " here ";
        }
        if ($selected == $u->user_id){
          $class .= " selected ";
        }

        $clancolor = ($u->clan != null)?"#".substr(md5($u->clan),0,6):'#ffffff';

        $html .= "<div class='rank $participante $class'>
          <input type='hidden' name='id' value='".$u->user_id."'/>
          <img class='rank-img' style='border-color:$clancolor' src='http://1.gravatar.com/avatar/".$u->user_id."?s=50&d=monsterid&r=G' />
          <span class='rank-nick' >".recortar_texto($u->fullname,17)."</span>
          <span class='rank-puntos'>".$u->puntos."</span>
          <span class='rank-rank'>".$rank++."#</span>
          <span class='rank-racha'>combo<br>x".$u->racha."</span>
          ".$logo."
        </div>";
      }

      $html .= "<br clear='left'/></div>";
      echo $html;

    }


    function load_ganadores(){

      $this->load->model('usuario');
      $usuarios = $this->usuario->get_ganadores();

      $html = '';

      $rank = 1;



      //for ($i = 0 ; $i<14 ;$i++) 
      foreach ($usuarios as $u) {

       $clancolor = ($u->clan != null)?"#".substr(md5($u->clan),0,6):'#ffffff';

        $html .= "<div class='rank'> 
          <img class='rank-img' style='border-color:$clancolor' src='http://1.gravatar.com/avatar/".$u->user_id."?s=100&d=monsterid&r=G' />
          <span class='rank-nick' style='border-color:$clancolor'>".recortar_texto($u->fullname,10)."</span>
          <span class='rank-puntos' style='border-color:$clancolor'>".recortar_texto($u->clan,10)."</span>
          <span class='rank-rank'>".$rank++."#</span>
          
        </div>";
      }

      $html .= "<br clear='left'/></div>";
      echo $html;

    }

    function usar_vitamina($instancia_vitamina_id = 0,$target_id = 0){
      $this->load->model(array('usuario' , 'vitamina'));

      $this->load->add_package_path(APPPATH.'third_party/bitauth/');
      $this->load->library('bitauth');
      if (!$this->bitauth->logged_in()) return false;

      if (!$instancia_vitamina_id || !$target_id) return false;

      //update de valores
      $user_db = $this->usuario->get_usuario($target_id);
      $this->bitauth->update_user(
      $target_id,
      array('racha'=>$user_db[0]->racha,
          'puntos'=>$user_db[0]->puntos)
      );


      if ($this->vitamina->vitamina_usable($instancia_vitamina_id) && $this->usuario->target_usable($target_id)){
        //podemos hacer cambios

        $this->vitamina->usar($instancia_vitamina_id,$target_id);

      } else {
        ECHO "HACKER!";
        return false;
      }



    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */