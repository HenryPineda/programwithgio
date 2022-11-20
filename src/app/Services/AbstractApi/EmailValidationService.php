<?php

namespace App\Services\AbstractApi;

use App\Contracts\EmailValidationInterface;
use App\Contracts\RetryMiddlewareInterface;
use App\DTO\EmailValidationResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Response;



class EmailValidationService implements EmailValidationInterface
{
    private string $baseUrl = 'https://emailvalidation.abstractapi.com/v1/';
    private RetryMiddlewareInterface $retryMiddleware;
    public function __construct(RetryMiddlewareInterface $retryMiddleware, private string $apiKey)
    {
        $this->retryMiddleware = $retryMiddleware;
    }

    public function verify(string $email):EmailValidationResult
    {
        $stack = HandlerStack::create();

        $maxRetry = 3;

        $stack->push($this->retryMiddleware->getRetryMiddleware($maxRetry));


        $client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'timeout' => 30,
                'handler' => $stack
            ]
        );

//        $handle = curl_init();

        $params = [
            'email' => $email,
            'api_key' => $this->apiKey,
        ];

//        $url = $this->baseUrl. 'verify?' . http_build_query($params);
        $response = $client->get('', ['query' => $params]);

        $body = json_decode($response->getBody()->getContents(), true);

        var_dump($body);
        return new EmailValidationResult((int)($body['quality_score']  * 100), (boolean)($body['deliverability'] ==='DELIVERABLE'));
        //return new EmailValidationResult(80, true);
//        curl_setopt($handle, CURLOPT_URL, $url);
//        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//        $content = curl_exec($handle);
//
//        if($content !== false){
//            return json_decode($content, true);
//        }
//Copi
//        return [];
    }

    /**
     * @param int $maxRetry
     * @return callable
     */
    private function getRetryMiddleware(int $maxRetry): callable
    {
        return Middleware::retry(
            function (int $retries,
                      RequestInterface $request,
                      ?Response $response,
                      ?\RuntimeException $e = null
            ) use($maxRetry){
                if($retries >= $maxRetry ){
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