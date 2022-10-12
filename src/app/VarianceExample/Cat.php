<?php

namespace App\VarianceExample;

use App\VarianceExample\Animal;

class Cat extends Animal
{
    public function speak()
    {
        echo $this->name . ' meows.';
    }
}