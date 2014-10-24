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

        $this->load->model(array('vitamina','usuario','admin'));
		
    }

    public function index(){
        ?>
    	<h1>menu</h1>
            <ul>
                <li><a href="/debug/usuarios">Usuarios</a></li>
                <li><a href="/debug/vitaminas">Vitaminas</a></li>
                <li><a href="/debug/fechas">Fechas</a></li>
            </ul>
        <?php
	}	

	public function give($vitamina_id = 0){
		
        if ($vitamina_id != 0) {
			$this->vitamina->crear_nueva('1','0',$vitamina_id);
			echo "vitamina id=".$vitamina_id. " creada.";
		}
	}

    public function usuarios(){

    }
    
    public function vitaminas(){
   
            if (isset($_POST['nombre'])){

                $data = array(
                    'id' => $this->input->post('id'),
                    'nombre' => $this->input->post('nombre'),
                    'descripcion' => $this->input->post('descripcion'),
                    'time' => $this->input->post('time'),
                    'categoria' => $this->input->post('categoria'),
                    'fichero' => $this->input->post('fichero'),
                    );

                $this->admin->save_vitamina($data);
            }

            $vitaminas = $this->vitamina->get_listado();
            $ficheros = scandir(APPPATH."models/vitaminas");
            $data = array(
                'ficheros' => $ficheros,
                'title' => "Listado de vitaminas",
                'vitaminas' => $vitaminas
            );


           // echo "<pre>"; print_r($data);exit;
            $this->twiggy->set($data);
            $this->twiggy->display('debug/vitaminas',$data);
        

    }
    
    public function fechas(){

    }


}

