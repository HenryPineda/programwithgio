<?php

namespace App\Services\Shipping;

class PackageDimension implements ValueObjectInterface
{
    public function __construct(public readonly int $width, public readonly int $height, public readonly int $length)
    {
        match(true){
            $this->width <=0 || $this->width >= 80 => throw new \InvalidArgumentException('Invalid package width'),
            $this->height <=0 || $this->height >= 120 => throw new \InvalidArgumentException('Invalid package height'),
            $this->length <=0 || $this->length >= 150 => throw new \InvalidArgumentException('Invalid package length'),
            default => true
        };
    }

    public function incrementWidth(int $width):self
    {
        return new self($this->width + $width, $this->height, $this->length);
    }

    public function equalTo($other):bool
    {
        return $this->width === $other->width && $this->height === $other->height && $this->length === $other->length;
    }
}