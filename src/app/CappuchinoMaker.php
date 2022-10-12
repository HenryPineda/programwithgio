<?php

namespace App;

use App\Cappuchinoable;
use App\MakeCappuchino;

class CappuchinoMaker extends CoffeeMaker implements Cappuchinoable
{
    use MakeCappuchino;

}