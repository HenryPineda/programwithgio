<?php

namespace App\Middlewares;

use App\Contracts\RetryMiddlewareInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class RetryMiddleware implements RetryMiddlewareInterface
{

    /**
     * @return callable
     */
    public function getRetryMiddleware(int $maxRetry): callable
    {
        return Middleware::retry(
            function (int $retries, RequestInterface $request, ?Response $response, ?\RuntimeException $e = null) use($maxRetry) {
                if($retries >= $maxRetry){
                    return false;
                }

                //we have an array of status codes to check against
                if($response && in_array($response->getStatusCode(), [249, 429, 503])){
                    echo 'Retrying ['. $retries . '], Status: '. $response->getStatusCode(). '<br />';
                    return true;
                }

                if($e instanceof ConnectException){
                    echo 'Retrying ['. $retries . '], Connection Error<br />';
                    return true;
                }

                echo 'Not retrying <br />';

                return false;
            }
        );
    }
}