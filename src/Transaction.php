<?php

declare(strict_types=1);
class Transaction
{
    public float $amount;
//    public string $description;
    private ?Customer $customer = null;

    public function __construct(
        float $amount,
        public ?string $description = null)
    {
        $this->amount = $amount;
        $this->description = $description;
    }

    public function addTax(float $rate):self
    {
        $this->amount += $this->amount * $rate / 100;
        return $this;
    }

    public function applyDiscount(float $percent):self
    {
        $this->amount -= $this->amount * $percent / 100;
        return $this;
    }

    public function getAmount():float
    {
        return $this->amount;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): Customer|null
    {
        return $this->customer;
    }

}