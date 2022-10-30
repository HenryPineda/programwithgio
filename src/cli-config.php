<?php

require 'vendor/autoload.php';

use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$connectionParams = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => 'pdo_mysql',
];


$entityManager = EntityManager::create(
    $connectionParams,
    Setup::createAttributeMetadataConfiguration([__DIR__. '/app/Entities'], true)
);

$conn = $entityManager->getConnection();

$conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));