<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once "vendor/autoload.php";

$metadataCache = new ArrayAdapter();
$queryCache = new ArrayAdapter();

$config = new Configuration();
$config->setMetadataCache($metadataCache);
$config->setQueryCache($queryCache);

$driverImpl = new AttributeDriver([__DIR__ . '/src']);
$config->setMetadataDriverImpl($driverImpl);

if (PHP_VERSION_ID >= 80400) {
    $config->enableNativeLazyObjects(true);
} else {
    $config->setProxyDir(__DIR__ . '/proxies');
    $config->setProxyNamespace('Proxies');
    $config->setAutoGenerateProxyClasses(true);
}

$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => "localhost",
    'dbname' => "maint_app",
    'user' => "root",
    'password' => "root",
], $config);

$entityManager = new EntityManager($connection, $config);
