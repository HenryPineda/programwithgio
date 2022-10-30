<?php

namespace App;
use App\DB;
use App\Exceptions\RouteNotFoundException;
use App\Services\InvoiceServices;
use App\Services\PaddleGateway;
use App\Services\PaymentGatewayInterface;
use App\Services\SalesTaxService;
use App\Services\PaymentGatewayService;
use App\Services\EmailService;
use App\Services\StripeGateway;
use \PDO;
use App\Config;
use Symfony\Component\Mailer\MailerInterface;
use Dotenv\Dotenv;

class App
{
    public static DB $db;
    private Config $config;

    public function __construct(
        protected Container $container,
        protected ?Router $router = null,
        protected array $request = [])
    {

    }

    public static function db():DB
    {
        return static::$db;
    }

    public function boot():static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->config = new Config($_ENV);

        static::$db = DB::getInstance($this->config->db);
//        static::$db = new DB($this->config->db ?? []);
        $this->container->set(PaymentGatewayInterface::class, PaddleGateway::class);
        $this->container->set(MailerInterface::class, fn() => new CustomMailer($this->config->mailer['dsn']));

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