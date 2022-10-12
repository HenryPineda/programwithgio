<?php

namespace App;

trait MakeCappuchino
{
    public function makeCappuchino():string
    {
        return static::class . "is making cappuchino" . PHP_EOL;
    }

}