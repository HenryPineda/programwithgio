<?php

namespace App\VarianceExample;

class DogShelter implements AnimalShelter
{

    public function adopt(string $name): Dog
    {
        return new Dog($name);
    }

}