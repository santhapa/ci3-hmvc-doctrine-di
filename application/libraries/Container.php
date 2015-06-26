<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Container
{
	private $container;

	public function __construct()
	{
        $container = new ContainerBuilder();
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