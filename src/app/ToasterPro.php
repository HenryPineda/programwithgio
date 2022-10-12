<?php

namespace App;

class ToasterPro extends Toaster
{
    protected int $size;

    public function __construct()
    {
        parent::__construct();
        $this->size =4;
    }

    public function toastWithBagel()
    {
        foreach ($this->slices as $key => $value){
            echo ($key + 1). " Toasting ". $value. "with Bagel option!". "<br />";
        }
    }

}