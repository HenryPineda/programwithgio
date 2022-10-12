<?php

namespace App\PaymentGateway\Stripe;

use App\Enums\Status;

class Transaction
{

    private string $status;
    private static int $count = 0;

    public function __construct()
    {
//        echo '"'.__NAMESPACE__.'"';
        $this->status= STATUS::PENDING;
        self::$count++;
    }

    public function setStatus(string $status):self
    {
        if(!isset(Status::ALL_STATUSES[$status])){
           throw new \Exception('Status does not exists!');
        }
        $this->status = $status;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public static function getCount()
    {
        return self::$count;
    }
}