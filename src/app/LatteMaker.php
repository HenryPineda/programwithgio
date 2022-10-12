<?php

namespace App;

use App\Latteable;
use App\MakeLatte;

class LatteMaker extends CoffeeMaker implements Latteable
{
    use MakeLatte;
}