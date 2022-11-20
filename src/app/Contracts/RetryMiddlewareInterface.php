<?php

namespace App\Contracts;

interface RetryMiddlewareInterface
{
    public function getRetryMiddleware(int $maxRetry): callable;
}