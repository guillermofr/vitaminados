<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function index()
	{
		//change this code after install
		$this->load->spark('twiggy/0.8.5');

		if ($_POST){

			$consecutivos = $this->input->post('consecutivos');

			switch($this->input->post('type')){

				case 'recaptcha':

					$this->load->helper('recaptcha/recaptchalib');
					//require_once('recaptchalib.php'); // reCAPTCHA Library
					$privkey = "6Le4k-gSAAAAANIdExCmaoHeBPU4-mb1baMElBQc"; // Private API Key
					$verify = recaptcha_check_answer($privkey, $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

					if ($verify->is_valid) {
					  # Enter Success Code
					  echo "Your response was correct!";
					  $consecutivos = $consecutivos +1;
					}
					else {
					  # Enter Failure Code
					  echo "You did not enter the correct words.  Please try again.";
					  $consecutivos = 0;
					}


				break;

				case 'ayah':

					$this->load->helper('ayah/ayah');
					//require_once("ayah.php");
					$ayah = new AYAH();
					// Check to see if the user has submitted the form. You will need to replace
					// 'my_submit_button_name' with the name of your 'Submit' button.
					
			        // Use the AYAH object to see if the user passed or failed the game.
			        $score = $ayah->scoreResult();
			        if ($score)
			        {
			            // This happens if the user passes the game. In this case,
			            // we're just displaying a congratulatory message.
			                echo "Congratulations: you are a human!";
			                $consecutivos = $consecutivos +1;
			        }
			        else
			        {
			            // This happens if the user does not pass the game.
			            echo "Sorry, but we were not able to verify you as human. Please try again.";
			            $consecutivos = 0;
			        }
					


				break;
				default:
					echo "hacker!";
					$consecutivos = 0;
				break;
			}

		} else {
			$consecutivos = 0;
		}


		if ($consecutivos%2){
			$type = 'recaptcha';
		} else {
			$type = 'ayah';
		}
			

		switch ($type){

			case 'recaptcha':

				$data = array('consecutivos' => $consecutivos,'type' => 'recaptcha'); 
				$this->twiggy->set($data);
				$this->twiggy->display('captchas/recaptcha',$data);
			break;

			case 'ayah': 
				$this->load->helper('ayah/ayah');
					//require_once("ayah.php");
				$ayah = new AYAH();
				$data = array('consecutivos' => $consecutivos,'type' => 'ayah','ayah_game'=> $ayah->getPublisherHTML());
				$this->twiggy->set($data);
				$this->twiggy->display('captchas/ayah',$data);
			break;

		}


		

		

		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */