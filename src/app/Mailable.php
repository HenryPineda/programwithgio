<?php

namespace App;

interface Mailable
{
    public function sendEmail():string;
}