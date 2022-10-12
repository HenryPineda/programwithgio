<?php

namespace App;

trait MakeLatte
{
    public function makeLatte():string
    {
        return static::class . "is making lattee!". PHP_EOL;
    }

}