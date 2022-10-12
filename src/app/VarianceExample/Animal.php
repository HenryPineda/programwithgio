<?php

namespace App\VarianceExample;

use App\VarianceExample\AnimalFood;

abstract class Animal
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function speak();

    public function eat(AnimalFood $food)
    {
        echo $this->name . " eats ". get_class($food). PHP_EOL;
    }

}
