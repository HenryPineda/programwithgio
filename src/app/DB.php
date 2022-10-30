<?php

namespace App;
use \PDO;
use App\QueryBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

/**
 * @mixin Connection
 */
class DB
{
    public static ?DB $instance = null;
    public static int $count = 0;
//    private PDO $pdo;
    protected Connection $connection;

    private function __construct(array $config)
    {
//        $connectionParams = [
//            'dbname' => $config['db_name'],
//            'user' => $config['db_user'],
//            'password' => $config['db_pass'],
//            'host' => $config['db_host'],
//            'driver' => $config['db_driver'] ?? 'pdo_mysql',
//        ];
        $this->connection = DriverManager::getConnection($config);
//        $defaultOptions = [
//            PDO::ATTR_EMULATE_PREPARES => false,
//            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//        ];
//        try {
//            $this->pdo = new PDO(
//                $config['db_driver'].':host='. $config['db_host']. ';dbname='. $config['db_name'],
//                $config['db_user'],
//                $config['db_pass'],
//                $config['options'] ?? $defaultOptions);
//
//        }catch(\PDOException $e){
//            throw new \PDOException($e->getMessage(), $e->getCode());
//        }

    }

    public static function getInstance(array $configuration):DB
    {
        if(self::$instance === null) {
            self::$instance = new DB($configuration);
            //new DB($configuration);
            return self::$instance;
        }
        return self::$instance;
    }

    public function table(string $table)
    {
        $builder = new QueryBuilder($this->pdo);
        return $builder->selectAll($table);

    }

    public function __call(string $name, array $arguments)
    {
        var_dump($name, $arguments);
        //return call_user_func_array([$this->pdo, $name], $arguments);
        return call_user_func_array([$this->connection, $name], $arguments);
    }

}