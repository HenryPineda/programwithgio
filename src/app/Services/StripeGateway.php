<?php

namespace App\Services;

class StripeGateway implements PaymentGatewayInterface
{
    public function charge(array $customer,float $amount, float $tax):bool
    {
//        sleep(1);
        return (bool) mt_rand(0, 1);
    }

}