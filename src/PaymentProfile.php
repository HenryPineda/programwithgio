<?php

class PaymentProfile
{
    private int $id;

    public function __construct()
    {
        $this->id = rand();
    }

    /**
     * @return int
     */
    public function getId():int|null
    {
        return $this->id;
    }

}