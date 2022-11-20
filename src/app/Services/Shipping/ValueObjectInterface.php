<?php

namespace App\Services\Shipping;

interface ValueObjectInterface
{
    public function equalTo($other):bool;
}