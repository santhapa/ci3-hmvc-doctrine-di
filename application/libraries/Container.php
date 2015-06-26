<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class Container
{
	private $container;

	public function __construct()
	{
        $container = new ContainerBuilder();

        $phpLoader = new PhpFileLoader($container, new FileLocator(APPPATH));
		$phpLoader->load('services/services.php');

		foreach (glob(APPPATH.'modules/*/services', GLOB_ONLYDIR) as $m)
		{
			$loader = new YamlFileLoader($container, new FileLocator($m.'/'));
			$loader->load('services.yml');
		}
		
		$this->container = $container;
	}

	public function get($id)
	{
		return $this->container->get($id);
	}
}