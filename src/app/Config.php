<?php

namespace App;

/**
 * @property-read array $db
 * @property-read array $mailer
 */
class Config
{
    protected array $config = [];
    public function __construct(array $env)
    {
        $this->config = [
            'db'=> [
                'db_driver' => $env['DB_DRIVER'],
                'db_host' => $env['DB_HOST'],
                'db_name' => $env['DB_DATABASE'],
                'db_user' => $env['DB_USER'],
                'db_pass' => $env['DB_PASS']
            ],
            'mailer' => [
                'dsn' => $env['MAILER_DSN'] ?? ''
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name];
    }

}