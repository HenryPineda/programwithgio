<?php

namespace App;
use Traversable;

class Collection implements \IteratorAggregate
{
    //private array $items = [];

    public function __construct(private array $items)
    {
    }
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }
}