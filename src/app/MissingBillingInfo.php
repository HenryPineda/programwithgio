<?php

namespace App;

class MissingBillingInfo extends \Exception
{
    protected $message = 'Missing customer billing info';
}