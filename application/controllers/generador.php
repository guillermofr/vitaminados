<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generador extends CI_Controller {

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
    }

    function securimage(){
    	$this->load->helper('securimage/securimage');
		$image = new Securimage();

		// setting the background color to white
		$image->image_bg_color = new Securimage_Color('#E74C3C');
		// setting the text color to a dark grey
		$image->text_color = new Securimage_Color('#ffffff');
		// setting the line color to a dark gray to match the text
		$image->line_color = new Securimage_Color('#ffffff');


		$this->load->add_package_path(APPPATH.'third_party/bitauth');
        $this->load->library('bitauth');

        if ($this->bitauth->logged_in()) {
        	
        	
        	$own = $this->bitauth->get_user_by_id($this->bitauth->user_id);
			$own_puntos = $own->puntos;
			$own_racha = $own->racha;

        	$image->perturbation = min($own_racha /300,2);
			$image->num_lines = min($own_racha/14,40); 

        } else {

        	$image->perturbation = 0;
			$image->num_lines = 0; 

        }



		$image->show();
    }
	
}