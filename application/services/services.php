<?php
use Symfony\Component\DependencyInjection\Reference;

$CI =& get_instance();
$em = $CI->doctrine->em;

$container->setParameter('entityManager', $em);

// $container
// 	->register('model_manager', 'ModelManager')
// 	->addArgument('%entityManager%');

?>