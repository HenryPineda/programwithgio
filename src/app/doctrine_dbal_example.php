<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require_once __DIR__. '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$connectionParams = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => 'pdo_mysql',
];
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

//$connectionParams = [
//    'url' => 'mysql://root:root@127.0.0.1/course_db',
//];
//$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);


//$stm = $conn->prepare('SELECT * FROM invoices');
//
//$result = $stm->executeQuery();

$ids = [1, 2, 3, 4, 5];
//?, ?, ?,
//$parameters = '('. str_repeat('?, ', count($ids) -1). '?)';
//$sql = 'SELECT * FROM invoices WHERE id IN'. $parameters;
//var_dump($sql);
//$stm = $conn->prepare($sql);

//$result = $conn->executeQuery('SELECT * FROM invoices WHERE id IN(?)', [$ids], [\Doctrine\DBAL\Connection::PARAM_INT_ARRAY]);

$result = $conn->fetchAllAssociative('SELECT * FROM invoices WHERE id IN(?)', [$ids], [\Doctrine\DBAL\Connection::PARAM_INT_ARRAY]);
//$from = new DateTime('08/01/2022 00:00:00');
//$to = new DateTime('10/10/2022 00:00:00');
////
//$stm->bindValue(':from', $from, 'datetime');
//$stm->bindValue(':to', $to, 'datetime');
//$result = $stm->executeQuery($ids);
$queryBuilder = $conn->createQueryBuilder();

$invoices = $queryBuilder
        ->select('id','amount', 'created_at')
        ->from('invoices')
        ->where('amount > ?')
        ->setParameter(0, 6000)
        ->fetchAllAssociative();

var_dump($result);

var_dump('INVOICES',$invoices);
