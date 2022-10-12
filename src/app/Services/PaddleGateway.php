<?php

namespace App\Services;

class PaddleGateway implements PaymentGatewayInterface
{

    public function charge(array $customer, float $amount, float $tax): bool
    {
        Echo "Processed the invoice from the paddle class!";
        return true;
    }
}