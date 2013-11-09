<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

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
        $this->load->add_package_path(APPPATH.'third_party/bitauth');
        $this->load->library('bitauth');
    }

    public function index(){
    	$data = array();
    	$data['logueado'] = $this->bitauth->logged_in();
		$data['user'] = ($data['logueado'])?$this->bitauth->get_user_by_id($this->bitauth->user_id):false;
		$this->twiggy->set($data);
		$this->twiggy->display('info/jugar');
    }

    public function ranking(){
    	$data = array();
    	$data['logueado'] = $this->bitauth->logged_in();
		$data['user'] = ($data['logueado'])?$this->bitauth->get_user_by_id($this->bitauth->user_id):false;
		$this->twiggy->set($data);
		$this->twiggy->display('info/ranking');
	}

	public function developer(){
		$data = array();
    	$data['logueado'] = $this->bitauth->logged_in();
		$data['user'] = ($data['logueado'])?$this->bitauth->get_user_by_id($this->bitauth->user_id):false;
		$this->twiggy->set($data);
		$this->twiggy->display('info/developer');
	}

	public function premios(){
		$data = array();
    	$data['logueado'] = $this->bitauth->logged_in();
		$data['user'] = ($data['logueado'])?$this->bitauth->get_user_by_id($this->bitauth->user_id):false;
		$this->twiggy->set($data);
		$this->twiggy->display('info/premios');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */