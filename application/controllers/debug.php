<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends CI_Controller {


	function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/bitauth');
        $this->load->library('bitauth');
        $this->load->spark('twiggy/0.8.5');

        if (!$this->bitauth->logged_in()){
        	$this->twiggy->display('jugar');
        	exit;
        }

        $this->load->model(array('vitamina','usuario'));
		
    }

    public function index(){
    	echo "debug";
	}	

	public function give($vitamina_id = 0){
		
        echo "cerrado el debug"; exit;


        if ($vitamina_id != 0) {
			$this->vitamina->crear_nueva('1','0',$vitamina_id);
			echo "vitamina id=".$vitamina_id. " creada.";
		}
	}
}

