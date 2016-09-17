<?php
// DIC configuration

use GraphAware\Neo4j\Client\ClientBuilder;

$container = $app->getContainer();

// view renderer
/**
 * @param \Interop\Container\ContainerInterface $c
 * @return \Slim\Views\PhpRenderer
 */
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};


$container['redis'] = function ($c) {
    $settings = $c->get('settings')['redis'];
    $redis = new \Predis\Client(
        $settings['connection']
    );

    return $redis;
};


$container['em'] = function ($c) {
    $settings = $c->get('settings')['neo4j'];
    $connection = $settings['connection'];

    return \GraphAware\Neo4j\OGM\EntityManager::create(
        sprintf(
            '%s://%s:%s@%s:%d',
            $connection['protocol'],
            $connection['username'],
            $connection['password'],
            $connection['host'],
            $connection['port']
        )
    );
};