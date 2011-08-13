<?php

$loader->import('config.php');

$container->loadFromExtension('framework', array(
    'profiler' => array('only-exceptions' => false, 'dsn' => 'sqlite:%kernel.root_dir%/logs/profiler.db'),
    'templating' => array(
    'engines' => array('php', 'twig'),
    ),
));

$container->loadFromExtension('web_profiler', array(
    'toolbar' => false,
    'intercept-redirects' => false,
));

$container->loadFromExtension('monolog', array(
    'handlers' => array('main' => array(
        'type' => 'stream',
        'path' => '%kernel.logs_dir%/%kernel.environment%.log',
        'level' => 'debug'
    ),
)));

//Doctrine
$container->loadFromExtension('doctrine', array('dbal' => array(
            'driver'  => 'pdo_mysql',
            'host' => 'localhost',
            'dbname'    => 'tbq',
            'user'      => 'root',
            'password'  => 'root',
)));

// Twig Configuration
$container->loadFromExtension('twig', array(
    'debug' => '%kernel.debug%',
    'strict_variables' => '%kernel.debug%',
));

$container->loadFromExtension('assetic', array(
    'debug' => false,
));