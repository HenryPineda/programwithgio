<?php

namespace App;

use App\MakeLatte;
use App\MakeCappuchino;

class AllInOneCoffeeMaker extends CoffeeMaker implements Latteable, Cappuchinoable
{
    use MakeLatte, MakeCappuchino;

}