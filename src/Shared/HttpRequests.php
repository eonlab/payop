<?php

namespace Eonlab\Shared;

use Eonlab\APIResponse;
use Eonlab\Types\HttpMethod;
//use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Client;
use InvalidArgumentException;

class HttpRequests
{
    public function __construct()
    {
        $this->client = new Client();

    }

    /**
     * Send Request & Handle API Response
     *
     * @param string $method
     * @param string $uri
     * @param array  $payload
     *
     * @return APIResponse
     * @throws \BNG\Exceptions\ServiceException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function _request(string $method, string $uri, array $payload = [])
    {
        $headers = [
            'Content-type'  => 'application/json',
            'Authorization' => $this->apiKey(),
        ];
        switch ($method) {
            case HttpMethod::GET:
                $response = $this->client->get($uri, [
                    'headers' => $headers,
                ]);

                return new APIResponse($response);
                break;

            case HttpMethod::POST:
                $response = $this->client->post($uri, [
                    'headers' => $headers,
                    'json'    => $payload,
                ]);
                return new APIResponse($response);
                break;
            case HttpMethod::DELETE:
                $response = $this->client->delete($uri, [
                    'headers'     => $headers,
                    'form_params' => $payload,
                ]);
                return new APIResponse($response);
                break;

            default:
                throw new InvalidArgumentException('Unknown Http Method !');
                break;
        }
    }

    protected function apiKey()
    {
        return 'Bearer ' . $this->serviceToken;
    }
}
