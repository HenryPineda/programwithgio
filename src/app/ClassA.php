<?php

namespace App;

class ClassA
{
    protected static string $name = 'A';

    public static function getName():string
    {
        var_dump(get_called_class());
        $class = get_called_class();
        //return $class::$name;
        //return self::$name;
        return static::$name;
    }

    public static function make():static
    {
        return new static;
    }

}