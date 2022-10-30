<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use App\Entities\Invoice;
use App\Enums\InvoiceStatus;
use App\Entities\InvoiceItem;
use Doctrine\ORM\Tools\Setup;

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


$entityManager = \Doctrine\ORM\EntityManager::create(
    $connectionParams,
    Setup::createAttributeMetadataConfiguration([__DIR__. '/Entities'])
);

$items = [
    ['Item 1', 1, 15],
    ['Item 2', 2, 7.5],
    ['Item 3', 4, 3.75]
];

//$invoice = (new Invoice())
//    ->setAmount(300)
//    ->setUserId(1)
//    ->setStatus(InvoiceStatus::PENDING)
//    ->setCreatedAt(new DateTime())
//    ->setInvoiceNumber('12345');
//
//foreach ($items as [$description, $quantity, $unitPrice]){
//    $item = (new InvoiceItem())
//        ->setDescription($description)
//        ->setQuantity($quantity)
//        ->setUnitPrice($unitPrice)
//        ->setCreatedAt(new DateTime());
//
//    $invoice->addItem($item);
//
////    $entityManager->persist($item);
//}

//$entityManager->persist($invoice);

$invoice = $entityManager->find(Invoice::class, 28);

$invoice->setStatus(InvoiceStatus::PAID);
$invoice->getItems()->get(0)->setDescription('Description for item 1 in invoice 28');

$entityManager->flush();

$queryBuilder = $entityManager->createQueryBuilder();

$query = $queryBuilder
    ->select('i', 'it')
    ->from(Invoice::class, 'i')
    ->join('i.items', 'it')
    ->where(
        $queryBuilder->expr()->andX(
            $queryBuilder->expr()->gt('i.amount', ':amount'),
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->eq('i.status', ':status'),
                $queryBuilder->expr()->gte('i.created_at', ':date')
            )
        )
    )
    ->setParameter('amount', 100)
    ->setParameter('status', InvoiceStatus::PAID->value)
    ->setParameter('date', '2022-10-15 00:00:00')
    ->orderBy('i.id', 'desc')
    ->getQuery();

echo $query->getDQL(). PHP_EOL;

//var_dump($query->getArrayResult());
//exit;
//$queryFromDQl = $entityManager->createQuery(
//    'SELECT i.id, i.createdAt, i.amount FROM App\Entities\Invoice i WHERE i.amount > :amount ORDER BY i.createdAt desc'
//);
//
//$invoices =$queryFromDQl->getResult();

$invoices = $query->getResult();

//var_dump($invoices);

/** @var Invoice $invoice */
foreach ($invoices as $invoice)
{
    echo $invoice->getCreatedAt()->format('m/d/Y g:ia')
        . ', '. $invoice->getAmount()
        . ', '. $invoice->getStatus()->toString(). PHP_EOL;
    /** @var InvoiceItem $item */
    foreach ($invoice->getItems() as $item){
        echo ' - '. $item->getDescription()
            . ', - '. $item->getQuantity()
            . '. - '. $item->getUnitPrice() . PHP_EOL;
    }
}




