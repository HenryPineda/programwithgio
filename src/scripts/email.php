<?php

require __DIR__ . '/../vendor/autoload.php';

use App\App;
use App\Container;
use App\Services\EmailService;
use App\Config;

$container = new Container();

$app = new App($container);
$app->boot();
var_dump($app::db());
$dbInstance = $app::db();
var_dump($dbInstance::getInstance((new Config($_ENV))->db));


$container->get(EmailService::class)->sendQueuedEmails();