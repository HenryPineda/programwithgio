<?php

namespace App\VarianceExample;

use App\VarianceExample\Animal;
use App\VarianceExample\Food;

class Dog extends Animal
{
    public function speak()
    {
        echo $this->name . ' barks';
    }

    public function eat(Food $food)
    {
        echo $this->name . " eats ". get_class($food);
    }


}