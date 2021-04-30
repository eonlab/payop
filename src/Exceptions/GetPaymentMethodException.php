<?php


namespace Eonlab\Exceptions;


use Exception;
use Throwable;

class GetPaymentMethodException extends Exception
{
    /**
     * GetPaymentMethodException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Get Payment Methods Exception", $code = 0xF362B, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
