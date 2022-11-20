<?php


require __DIR__.'/../vendor/autoload.php';

use App\Services\Shipping\BillableWeightCalculatorService;
use App\Services\Shipping\PackageDimension;
use App\Services\Shipping\Weight;
use App\Services\Shipping\DimDivisor;

$package = [
    'weight' => 6,
    'dimensions' => [
        'width' => 9,
        'length' => 15,
        'height' => 7
    ],
];

$fedexDimDivisor = DimDivisor::FedexDimDivisor;

$packageDimensions = new PackageDimension($package['dimensions']['width'],$package['dimensions']['height'],$package['dimensions']['length']);

$widerPackageDimensions = $packageDimensions->incrementWidth(10);

$packageWeight = new Weight($package['weight']);

$billableWeightService = new BillableWeightCalculatorService();

$billableWeight = $billableWeightService->calculate(
    $packageDimensions,
    $packageWeight,
    $fedexDimDivisor
);

$widerBillableWeight = $billableWeightService->calculate(
    $widerPackageDimensions,
    $packageWeight,
    $fedexDimDivisor
);

echo $billableWeight . 'lb'. PHP_EOL;
echo $widerBillableWeight . 'lb' . PHP_EOL;