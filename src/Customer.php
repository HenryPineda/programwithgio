<?php

class Customer
{
    public ?PaymentProfile $paymentProfile = null;

    /**
     * @return PaymentProfile|null
     */
    public function getPaymentProfile():PaymentProfile|null
    {
        return $this->paymentProfile;
    }
}