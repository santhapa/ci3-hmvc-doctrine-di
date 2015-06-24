<?php
// application.php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;

define('BASEPATH', dirname(__DIR__));
define('APPPATH', 'application/');
define('EXT', '.php');

require_once APPPATH."libraries/Doctrine.php";

$doctrine = new Doctrine();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
		'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($doctrine->em->getConnection()),
		'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($doctrine->em),
		'dialog' => new \Symfony\Component\Console\Helper\DialogHelper()
));


$cli = new Application();

$cli->setHelperSet($helperSet);
$cli->addCommands(array(
		// new Doctrine\DBAL\Tools\Console\Command\ImportCommand(),
		// new Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand(),
		// new Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
		// new Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
		// new Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
		// new Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
		// new Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
		// new Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand(),
		// new Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
		// new Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
		// new Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand()

		// DBAL Commands
		new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
	    new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),
	    
	    // ORM Commands
	    new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),
	    new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),
));

$cli->run();