<?php

namespace App\VarianceExample;

class CatShelter implements AnimalShelter
{
    public function adopt(string $name): Cat
    {
        return new Cat($name);
    }

}
