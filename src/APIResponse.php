<?php

namespace Eonlab;


use Psr\Http\Message\ResponseInterface;
use Eonlab\Exceptions\ServiceException;
use Eonlab\Types\ResponseStatus;

/**
 * @author  : Uğur Müslim
 * @date    : 12.22.2021 21:00
 * @mail    : <ugurmuslim@bynogame.com>
 *
 * @package BNG;
 */
class APIResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var object
     */
    private $body;

    /**
     * APIResponse constructor.
     *
     * @param ResponseInterface $response
     *
     * @throws ServiceException
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $bodyContent = $response->getBody()->getContents();
        $this->body = json_decode($bodyContent);

        if (json_last_error() !== JSON_ERROR_NONE || empty($bodyContent)) {
            throw new ServiceException('API service is not responding');
        }
    }

    /**
     * Get Status Code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    /**
     * Get API Status Message
     *
     * @return string
     */
    public function getStatusMessage()
    {
        if (property_exists($this->body, 'status')) {
            $status = $this->body->status;

            return ( $status === ResponseStatus::SUCCESS ? ResponseStatus::SUCCESS :
                ( $status === ResponseStatus::FAILURE ? ResponseStatus::FAILURE :
                    ( $status === ResponseStatus::PENDING ? ResponseStatus::PENDING :
                        ResponseStatus::UNKNOWN
                    ) ) );
        }

        return ResponseStatus::UNKNOWN;
    }

    /**
     * Get API Response Data
     *
     * @return array|object|null
     */
    public function getBody()
    {
        if (property_exists($this->body, 'data')) {
            return $this->body->data;
        }

        return null;
    }


    public function geIdentifier(): string
    {
        $identifier = $this->response->getHeader('identifier');
        return $identifier[0];
    }
}
