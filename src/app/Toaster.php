<?php

namespace App;

class Toaster
{
    protected array $slices = [];
    protected int $size;

    public function __construct()
    {
        $this->size = 2;
    }

    public function addSlice(string $slice)
    {
        if(count($this->slices) < $this->size) {
          $this->slices[] = $slice;
        }
    }

    public function toast()
    {
        foreach ($this->slices as $key => $value){
            echo ($key + 1). " Toasting ". $value. "<br />";
        }
    }

}