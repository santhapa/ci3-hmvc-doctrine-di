<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ORM\Mapping\Driver\AnnotationDriver,
    Doctrine\DBAL\Logging\EchoSQLLogger,
    Doctrine\Common\EventManager,
    Gedmo\Timestampable\TimestampableListener,
    Gedmo\Sluggable\SluggableListener,
    Gedmo\Tree\TreeListener;

class Doctrine {

    public $em = null;

    public function __construct()
    {
        // load database configuration from CodeIgniter
        require_once APPPATH.'config/database.php';

        // Set up class loading. You could use different autoloaders, provided by your favorite framework,
        // if you want to.
        //require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';

        // We use the Composer Autoloader instead - just set
        // $config['composer_autoload'] = TRUE; in application/config/config.php
        //require_once APPPATH.'vendor/autoload.php';

        //A Doctrine Autoloader is needed to load the models
        // first argument of classloader is namespace and second argument is path

        // setup class loading
        $entitiesClassLoader = new ClassLoader('models', APPPATH);
        $entitiesClassLoader->register();

        foreach (glob(APPPATH.'modules/*', GLOB_ONLYDIR) as $m) {
            $module = str_replace(APPPATH.'modules/', '', $m);
            $entitiesClassLoader = new ClassLoader($module, APPPATH.'modules');
            $entitiesClassLoader->register();
        }

        $loader = new ClassLoader('Proxies', APPPATH.'Proxies');
        $loader->register();

        // Set up Gedmo
        // $classLoader = new ClassLoader('Gedmo', APPPATH.'third_party');
        // $classLoader->register();
        // $evm = new EventManager;
        // // timestampable
        // $evm->addEventSubscriber(new TimestampableListener);
        // // sluggable
        // $evm->addEventSubscriber(new SluggableListener);
        // // tree
        // $evm->addEventSubscriber(new TreeListener);  

        // Set up caches
        $config = new Configuration;
        $cache = new ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models'));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        // Set up models
        $reader = new AnnotationReader($cache);
        // $reader->setDefaultAnnotationNamespace('Doctrine\ORM\Mapping\\');
        $models = array(APPPATH.'models');
        foreach (glob(APPPATH.'modules/*/models', GLOB_ONLYDIR) as $m)
            array_push($models, $m);
        $driver = new AnnotationDriver($reader, $models);
        $config->setMetadataDriverImpl($driver);

        // Proxy configuration
        $config->setProxyDir(APPPATH.'/proxies');
        $config->setProxyNamespace('Proxies');

        // Set up logger
        $logger = new EchoSQLLogger;
        $config->setSQLLogger($logger);

        $config->setAutoGenerateProxyClasses( TRUE );

        // Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' =>     $db['default']['username'],
            'password' => $db['default']['password'],
            'host' =>     $db['default']['hostname'],
            'dbname' =>   $db['default']['database']
        );

        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}