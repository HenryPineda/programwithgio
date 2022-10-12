<?php

namespace App;

class NotFoundViewException extends \Exception
{
    protected $message = "View not found";
}