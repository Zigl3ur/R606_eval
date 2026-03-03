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

$dbHost     = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: '127.0.0.1';
$dbName     = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'maint_app';
$dbUser     = $_ENV['DB_USER'] ?? getenv('DB_USER') ?: 'root';
$dbPassword = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: 'root';

$tmpConnection = DriverManager::getConnection([
    'driver'   => 'pdo_mysql',
    'host'     => $dbHost,
    'user'     => $dbUser,
    'password' => $dbPassword,
], $config);
$tmpConnection->executeStatement(
    'CREATE DATABASE IF NOT EXISTS `' . $dbName . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
);
$tmpConnection->close();

$connection = DriverManager::getConnection([
    'driver'   => 'pdo_mysql',
    'host'     => $dbHost,
    'dbname'   => $dbName,
    'user'     => $dbUser,
    'password' => $dbPassword,
], $config);

$entityManager = new EntityManager($connection, $config);
