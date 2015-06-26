<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use welcome\models\Welcome;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;



class Welcome_Controller extends MX_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$names = $this->doctrine->em->getRepository('\welcome\models\Welcome')->findAll();

		$welcome = $this->container->get('welcome');
		echo $welcome->echoHello();
		echo '<br>';
		
		$this->load->view('index', array('names'=> $names));
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
