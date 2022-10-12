<?php

namespace App;

class CoffeeMaker
{
    public function makeCoffee():string
    {
        return static::class . 'is making coffee!'. PHP_EOL;
    }
}