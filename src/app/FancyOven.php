<?php

namespace App;

class FancyOven
{

    public function __construct(private ToasterPro $toaster)
    {
    }

    public function fry()
    {

    }

    public function toast()
    {
        $this->toaster->toast();
    }

    public function toastBagel()
    {
        $this->toaster->toastWithBagel();
    }

    public function addSlice(string $slice):void
    {
        $this->toaster->addSlice($slice);
    }

}