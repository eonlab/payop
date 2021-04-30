<?php


namespace Eonlab\Exceptions;


use Exception;
use Throwable;

class CardTokenizationException extends Exception
{
    /**
     * CardTokenizationException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Card Tokenization Error", $code = 0xF362B, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
