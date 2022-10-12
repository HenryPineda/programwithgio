<?php

namespace App\Exceptions;

class FileDoesNotExistException extends \Exception
{
    protected $message = 'File does not exists!';

}