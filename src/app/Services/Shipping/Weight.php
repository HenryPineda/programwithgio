<?php

namespace App\Services\Shipping;

class Weight implements ValueObjectInterface
{
    public function __construct(public readonly int $value)
    {
        match(true){
            $this->value <=0 || $this->value >= 150 => throw new \InvalidArgumentException('Invalid package weight'),
            default => true
        };

    }

    public function increaseWeight(int $weight):self
    {
        return new self($this->value + $weight);
    }

    public function equalTo($other):bool
    {
        return $this->value ===$other->value;
    }
}