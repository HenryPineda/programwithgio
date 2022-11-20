<?php

//Video 78 Attributes

require __DIR__ . '/../vendor/autoload.php';
//echo dirname(__DIR__);

define('STORAGE_PATH', __DIR__.'/../storage');
define('VIEW_PATH', __DIR__.'/../views');

use App\Router;
use App\Controllers\InvoiceController;
use App\Controllers\HomeController;
use App\Controllers\GeneratorExampleController;
use App\App;
//use App\Container;
use Illuminate\Container\Container;
use App\Controllers\UserController;
use App\Controllers\CurlController;

$container = new Container();

$router = new Router($container);

    $router->registerRoutesFromControllersAttributes(
       [
           HomeController::class,
           GeneratorExampleController::class,
           InvoiceController::class,
           UserController::class,
           CurlController::class
       ]
    );

//    echo '<pre>';
//    print_r($router->getRoutes());
//    echo '</pre>';

//    $router
//        ->get('/', [HomeController::class, 'index'])
//        ->get('/examples/generator', [GeneratorExampleController::class, 'index'])
//        ->get('/signup', [HomeController::class, 'signUp'])
//        ->get('/download', [HomeController::class, 'download'])
//        ->post('/upload', [HomeController::class, 'upload'])
//        ->get('/invoices', [InvoiceController::class, 'index'])
//        ->get('/invoices/create', [InvoiceController::class, 'create'])
//        ->post('/invoices', [InvoiceController::class, 'store']);

(new App(
    $container,
    $router,
    ['uri'=> $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->boot()->run();




//Video 77 Variance


//use App\VarianceExample\CatShelter;
//use App\VarianceExample\DogShelter;
//use App\VarianceExample\AnimalFood;
//use App\VarianceExample\Food;
//
//require __DIR__ . '/../vendor/autoload.php';
//
//$kitty = (new CatShelter)->adopt('Ricky');
//$kitty->speak();
//echo PHP_EOL;
//
//$catFood = new AnimalFood;
//$kitty->eat($catFood);
//
//$doggy = (new DogShelter)->adopt('Mavrick');
//$doggy->speak();
//echo PHP_EOL;
//
//$dogFood = new Food;
//$doggy->eat($dogFood);

//Video 61 MVC pattern

//require __DIR__ . '/../vendor/autoload.php';
////echo dirname(__DIR__);
//$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
//$dotenv->load();
//define('STORAGE_PATH', __DIR__.'/../storage');
//define('VIEW_PATH', __DIR__.'/../views');
//
//use App\Router;
//use App\Controllers\InvoiceController;
//use App\Controllers\HomeController;
//use App\Controllers\GeneratorExampleController;
//use App\App;
//use App\Config;
//use App\Container;
//
//$container = new Container();
//
//$router = new Router($container);
//
//    $router
//        ->get('/', [HomeController::class, 'index'])
//        ->get('/examples/generator', [GeneratorExampleController::class, 'index'])
//        ->get('/signup', [HomeController::class, 'signUp'])
//        ->get('/download', [HomeController::class, 'download'])
//        ->post('/upload', [HomeController::class, 'upload'])
//        ->get('/invoices', [InvoiceController::class, 'index'])
//        ->get('/invoices/create', [InvoiceController::class, 'create'])
//        ->post('/invoices', [InvoiceController::class, 'store']);
//
//(new App(
//    $container,
//    $router,
//    ['uri'=> $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
//    new Config($_ENV)
//))->run();


//Video 57 superglobals, Video 60 PHP File uploads
//require __DIR__ . '/../vendor/autoload.php';
//define('STORAGE_PATH', __DIR__.'/../storage');
////session_start();
//
//use App\Router;
//use App\InvoiceController;
//use App\HomeController;
//
////echo "<pre >";
////print_r($_SERVER);
////echo "</pre>";
//
////echo "<pre >";
////print_r($_REQUEST);
////echo "</pre>";
////echo __DIR__.PHP_EOL;
//
//$router = new Router();
//
//$router
//    ->get('/', [HomeController::class, 'index'])
//    ->post('/upload', [HomeController::class, 'upload'])
//    ->get('/invoices', [InvoiceController::class, 'index'])
//    ->get('/invoices/create', [InvoiceController::class, 'create'])
//    ->post('/invoices', [InvoiceController::class, 'store']);
//$router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
//
////var_dump($_SESSION);
//
//echo "<pre >";
//print_r($_COOKIE);
//echo "</pre>";


//Video 56 Iterators and Iterable Type
//require __DIR__ . '/../vendor/autoload.php';
//use App\Invoice;
//use App\InvoiceCollection;
//
//foreach (new Invoice(25, 'Testing the iterable type', '34918734917', new \App\Customer([])) as $key => $value){
//    echo $key. '-'.$value. PHP_EOL;
//}
//
//$invoiceCollection = new InvoiceCollection([
//    new Invoice(15, 'Testing the iterable type', '34918734917', new \App\Customer([])),
//    new Invoice(25, 'Testing the iterable type 2', '34997134917', new \App\Customer([])),
//    new Invoice(50, 'Testing the iterable type 3', '34913434917', new \App\Customer([])),
//]);
//
//foreach ($invoiceCollection as $key => $invoice){
//    echo $key. '-'. $invoice->id . '-' . $invoice->amount.PHP_EOL;
//}


//Video 55 DateTime Object
//require __DIR__ . '/../vendor/autoload.php';
//
//$date = new DateTime("now", new DateTimeZone("America/Managua"));
//var_dump($date);
//echo $date->getTimezone()->getName() . '-' . $date->format("l, M jS Y H:i:sa"). PHP_EOL;
//$date->setTimezone(new DateTimeZone("Europe/Amsterdam"));
//var_dump($date);
////$date->setDate(2023, 7, 3)->setTime(7, 30, 50);
//echo $date->getTimezone()->getName() . '-' . $date->format("l, M jS Y H:i:sa"). PHP_EOL;
//var_dump($date->getTimezone()->getName());
//var_dump($date->getTimezone()->getLocation());
//$date2 = DateTime::createFromFormat("d-m-Y","12-05-2022", new DateTimeZone("America/Managua"));
//var_dump($date2);
//
////$interval = $date->diff($date2);
//$interval = new DateInterval('P1Y2M');
//var_dump($interval);
//$date->add($interval);
//var_dump($date);
//
////$period = new DatePeriod(new DateTime('now', new DateTimeZone('America/Managua')), new DateInterval('P1D'), 4, DatePeriod::EXCLUDE_START_DATE);
//$period = new DatePeriod(new DateTime('now', new DateTimeZone('America/Managua')), new DateInterval('P7D'), new DateTimeImmutable('8/15/2022'), DatePeriod::EXCLUDE_START_DATE);
//
//foreach ($period as $date){
//    echo $date->format('m/d/Y').PHP_EOL;
//}

//echo $date2->format("l, M jS Y g:i:sa");

//Video 54 OOP Error handling in php
//require __DIR__ . '/../vendor/autoload.php';
//use App\Invoice;
//use App\Customer;
//
//$invoice = new Invoice(-25, 'A negative invoice', '0741937493', new Customer([]) );
//
//try {
//    $invoice->process(25, 'A negative invoice');
//}catch(\Throwable $e){
//    echo $e->getMessage();
//}finally{
//    echo "This code always run!";
//}


// Video 53 Object serialization
//require __DIR__ . '/../vendor/autoload.php';
//use App\Invoice;
//
//$invoice = new Invoice(125.50, 'Invoice 1', '1349871341973');
//
//echo  serialize($invoice);
//$invoice2 = unserialize(serialize($invoice));
//var_dump($invoice2);
//$invoice2->process(15.50, 'Description of the invoice!');

// Video 48 PHP Traits
//
//require __DIR__ . '/../vendor/autoload.php';
//use App\CoffeeMaker;
//use App\LatteMaker;
//use App\CappuchinoMaker;
//use App\AllInOneCoffeeMaker;
//use App\Customer;
//
//$coffeMaker = new CoffeeMaker();
//
//echo $coffeMaker->makeCoffee();
//
//$latteMaker = new LatteMaker();
//echo $latteMaker->makeCoffee();
//echo $latteMaker->makeLatte();
//
//$cappuchinoMaker = new CappuchinoMaker();
//echo $cappuchinoMaker->makeCoffee();
//echo $cappuchinoMaker->makeCappuchino();
//
//$allInOneCoffeeMaker = new AllInOneCoffeeMaker();
//echo $allInOneCoffeeMaker->makeCoffee();
//echo $allInOneCoffeeMaker->makeLatte();
//echo $allInOneCoffeeMaker->makeCappuchino();
//$customer = new Customer();
//echo $customer->updateProfile();

//Video 47 Late Static Binding
//
//require __DIR__ . '/../vendor/autoload.php';
//
//use App\ClassA;
//use App\ClassB;
//
//$classA = new ClassA();
//$classB = new ClassB();
//
//echo $classA->getName().PHP_EOL;
//echo $classB->getName().PHP_EOL;
//
//$classB2 = ClassB::make();
//var_dump($classB2::getName());

//Video 46 Magic methods

//require __DIR__ . '/../vendor/autoload.php';
//
//use App\Invoice;
//
//$invoice = new Invoice();
//
//$invoice->amount = 10;
//$invoice->subTotal = 20;
//var_dump(isset($invoice->subTotal));
////unset($invoice->subTotal);
//echo $invoice->amount. PHP_EOL;
//var_dump($invoice);
//echo "<br />";
//
//$invoice->process(40, 'Testing calling a private method using the __call magic method and call_user_func_array');
//echo "<br />";
//Invoice::cancel(20, 'Cancel the order!');
//echo $invoice;
//$invoice(30, 'Invoking the class a function');
//

// Video 44 Abstract classes
//require __DIR__ . '/../vendor/autoload.php';
//use App\Text;
//use App\RadioButton;
//use App\CheckBox;
//use App\DebtCollectService;
//use App\CollectorAgency;
//use App\RockyCollector;
//
//$fields = [
//    new Text('textField'),
//    new RadioButton('radiobuttonField'),
//    new CheckBox('checkbuttonField')
//];
//
//foreach ($fields as $key => $value){
//    echo $value->render();
//}
//
//
//$collector = new DebtCollectService();
//$collectedAmount = $collector->CollectDebt(new RockyCollector());
//echo $collectedAmount. PHP_EOL;

//Video 43 Inheritance
//require __DIR__ . '/../vendor/autoload.php';
//
//use App\ToasterPro;
//use App\FancyOven;
//
//$toaster = new ToasterPro();
//$toaster->addSlice('regular bread');
//$toaster->addSlice('banana bread');
//$toaster->addSlice('Oat bread');
//$toaster->addSlice('Apple bread');
//
//$toaster->toastWithBagel();
//
//$fancyOven = new FancyOven(new ToasterPro());
//$fancyOven->addSlice('regular bread for oven');
//$fancyOven->toastBagel();
//Video 41 Static Properties and Methods in Object
//require __DIR__ . '/../vendor/autoload.php';
//
//use \Ramsey\Uuid;
//use App\PaymentGateway\Stripe\Transaction as StripeTransaction;
//use App\PaymentGateway\Paddle\Transaction as PaddleTransaction;
//use App\Enums\Status;
//use App\DB;
//
//$transaction = new StripeTransaction();
//$transaction = new StripeTransaction();
//$transaction = new StripeTransaction();
//$transaction->setStatus(Status::DECLINED);
//echo $transaction->getStatus();
//var_dump($transaction::getCount());
//
//$db = DB::getInstance([]);
//$db = DB::getInstance([]);
//echo $db::$count;

// Video 40 Class Constants

//require __DIR__.'/../vendor/autoload.php';
//use \Ramsey\Uuid;
//use App\PaymentGateway\Stripe\Transaction as StripeTransaction;
//use App\PaymentGateway\Paddle\Transaction as PaddleTransaction;
//use App\Enums\Status;
//
//$transaction = new StripeTransaction();
//$transaction->setStatus(Status::DECLINED);
//echo $transaction->getStatus();

//echo StripeTransaction::STATUS_DECLINED;
//Video 38 and Video 39 PHP Namespaces and PHP Standards, Autoloader and Composer
//require_once '../PaymentGateway/Paddle/Transaction.php';
//require_once '../PaymentGateway/Stripe/Transaction.php';

////This autoloader is not needed as we are using composer now.

//spl_autoload_register(function ($class) {
//    var_dump($class);
//
//    $prefix = 'App\\';
//    $base_dir = __DIR__.'/../';
//    $len = strlen($prefix);
//
//    if(strncmp($prefix, $class, $len) !==0){
//        return;
//    }
//
//    $path = dirname(__DIR__) . '/' . lcfirst(str_replace('\\', '/', $class)) . '.php';
//
//    if (file_exists($path)) {
//        require $path;
//    }
//});
//
//require __DIR__.'/../vendor/autoload.php';
//use \Ramsey\Uuid;
//use App\PaymentGateway\Stripe\Transaction as StripeTransaction;
//use App\PaymentGateway\Paddle\Transaction as PaddleTransaction;
//
//$id = new Uuid\UuidFactory();
//
//echo $id->uuid4();
//var_dump(new StripeTransaction());
//echo "Henry" . PHP_EOL;
//var_dump(new PaddleTransaction());

//// Video 36. Classes and Objects. Typed Properties, Constructors and destructors.
//declare(strict_types=1);
//
//require_once '../PaymentProfile.php';
//require_once '../Customer.php';
//require_once '../Transaction.php';
//
//$transaction1 = new Transaction(100, 'Transaction 1');
//
//$transaction1->addTax(8)->applyDiscount(10);
//
////$transaction1->customer = new Customer();
////$transaction1->customer->paymentProfile = new PaymentProfile();
////echo $transaction1->customer?->paymentProfile->id;
//
//echo $transaction1->getCustomer()?->getPaymentProfile()?->id ?? 'Id does not exist!';
//
//$transaction2 = new Transaction(200, 'Transaction 1');
//
//$transaction2->addTax(8)->applyDiscount(15);
//
//var_dump($transaction1->getAmount(), $transaction2->getAmount());

//phpinfo();

//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';
