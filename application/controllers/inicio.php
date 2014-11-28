<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
        $this->load->model(array('vitamina','usuario'));
    }

    public function index(){

		$this->load->spark('twiggy/0.8.5');
		$data = array();
		$data['ataques'] = $this->usuario->get_last_ataques();
		$this->twiggy->set($data);
		$this->twiggy->display('inicio',$data);

    }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */