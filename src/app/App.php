<?php

namespace App;
use App\Contracts\EmailValidationInterface;
use App\Contracts\RetryMiddlewareInterface;
use App\DB;
use App\Exceptions\RouteNotFoundException;
//use App\Services\Emailable\EmailValidationService;
use App\Middlewares\RetryMiddleware;
use App\Services\AbstractApi\EmailValidationService;
use App\Services\InvoiceServices;
use App\Services\PaddleGateway;
use App\Services\PaymentGatewayInterface;
use App\Services\SalesTaxService;
use App\Services\PaymentGatewayService;
use App\Services\EmailService;
use App\Services\StripeGateway;
use Illuminate\Database\Capsule\Manager as Capsule;
use \PDO;
use App\Config;
use Symfony\Component\Mailer\MailerInterface;
use Dotenv\Dotenv;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class App
{
    //public static DB $db;
    private Config $config;

    public function __construct(
        protected Container $container,
        protected ?Router $router = null,
        protected array $request = [])
    {

    }

//    public static function db():DB
//    {
//        return static::$db;
//    }
    /**
     * @param array $config
     * @return void
     */
    private function initDb(array $config):void
    {
        $capsule = new Capsule();

        $capsule->addConnection($config);
        $capsule->setEventDispatcher(new Dispatcher());

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function boot():static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->config = new Config($_ENV);

//        static::$db = DB::getInstance($this->config->db);
//        static::$db = new DB($this->config->db ?? []);

        $this->initDb($this->config->db);
        $this->container->bind(PaymentGatewayInterface::class, PaddleGateway::class);
        $this->container->bind(MailerInterface::class, fn() => new CustomMailer($this->config->mailer['dsn']));
        $this->container->bind(RetryMiddlewareInterface::class, fn()=> new RetryMiddleware());
        $this->container->bind(EmailValidationInterface::class, fn($container) => new EmailValidationService($container->make(RetryMiddlewareInterface::class), $this->config->apiKeys['abstract_api_email_validation_key']));
//        $this->container->bind(EmailValidationInterface::class, fn($container) => new EmailValidationService($container->make(RetryMiddlewareInterface::class),$this->config->apiKeys['emailable']));
        return $this;
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        }catch (RouteNotFoundException $e){
            //header('HTTP/1.1 404 Not Found');

            http_response_code(404);
            echo View::make('errors/error');
        }
    }

}