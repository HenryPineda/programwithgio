<?php

namespace App;

class Customer implements Mailable
{
    use Mail;

    public function __construct(private array $billingInfo = [])
    {
    }

    public function getBillingInfo():array
    {
        return $this->billingInfo;
    }

    public function updateProfile(): string
    {
        echo $this->sendEmail();
        return "The profile has been updated";
    }
}