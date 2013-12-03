<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends CI_Controller {


	function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/bitauth');
        $this->load->library('bitauth');
        $this->load->spark('twiggy/0.8.5');

        if (!$this->bitauth->logged_in() || $this->bitauth->username != 'killer415@gmail.com'){
        	$this->twiggy->display('inicio');
        	exit;
        }

        $this->load->model(array('vitamina','usuario'));
		
    }

    public function index(){
        ?>
    	<h1>menu</h1>

        <?php
	}	

	public function give($vitamina_id = 0){
		
        if ($vitamina_id != 0) {
			$this->vitamina->crear_nueva('1','0',$vitamina_id);
			echo "vitamina id=".$vitamina_id. " creada.";
		}
	}
}

