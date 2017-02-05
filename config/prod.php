<?php
$app['debug'] = FALSE;

$app['import.file.path'] = __DIR__.'/../var/messages_sample.json';
$app['import.cmd'] = 'mongoimport --db mailbox --collection items --jsonArray';

$app['doctrine.mongodb.connection.path'] = "mongodb://localhost:27017";
$app['doctrine.mongodb.connection'] = function($app) {
    return new Doctrine\MongoDB\Connection($app['doctrine.mongodb.connection.path']);
};


$app['doctrine.mongodb.driver.namespaces'] = array(
    __DIR__ => 'Mailbox\Documents'
);

$app['doctrine.mongodb.driver.basename'] = 'mapping';

$app['doctrine.mongodb.driver'] = function($app) {
    $driver = new \Doctrine\ODM\MongoDB\Mapping\Driver\SimplifiedYamlDriver($app['doctrine.mongodb.driver.namespaces']);
    $driver->setGlobalBasename($app['doctrine.mongodb.driver.basename']);
    return $driver;
};

$app['doctrine.mongodb.config.proxies'] = __DIR__ . '/../src/classes/Mailbox/Proxies';
$app['doctrine.mongodb.config.hydrators'] = __DIR__ . '/../src/classes/Mailbox/Hydrators';

$app['doctrine.mongodb.config'] = function($app) {
    $config = new \Doctrine\ODM\MongoDB\Configuration();
    $config->setProxyDir($app['doctrine.mongodb.config.proxies']);
    $config->setProxyNamespace('Proxies');
    $config->setHydratorDir($app['doctrine.mongodb.config.hydrators']);    
    $config->setHydratorNamespace('Hydrators');
    $config->setDefaultDB('mailbox');
    $config->setMetadataDriverImpl($app['doctrine.mongodb.driver']);
    return $config;
};

$app['doctrine.mongodb.dm'] = function($app) {
    return \Doctrine\ODM\MongoDB\DocumentManager::create($app['doctrine.mongodb.connection'], $app['doctrine.mongodb.config']);
};

$app['paginator.itemsperpage'] = 2;
$app['paginator'] = function($app) {
    return new \Mailbox\Utils\Paginator($app['paginator.itemsperpage']);
};

$app['main.controller'] = function($app) {
    return new \Mailbox\Controller\MainController($app['doctrine.mongodb.dm'], $app['paginator']);
};
