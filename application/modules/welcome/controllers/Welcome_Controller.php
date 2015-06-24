<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use welcome\models\Welcome;

class Welcome_Controller extends MX_Controller {

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
	public function index()
	{
		$names = $this->doctrine->em->getRepository('\welcome\models\Welcome')->findAll();

		$this->load->view('index', array('names'=> $names));
	}
	public function hey(){
		die("hey");
	}
	public function add(){
		$welcome = new Welcome();

		if($this->input->post())
		{
			$welcome->setText($this->input->post('name'));
			$em = $this->doctrine->em;
			$em->persist($welcome);
			$em->flush();
			redirect('welcome/index');
		}
		return $this->load->view('add');
	}
}
