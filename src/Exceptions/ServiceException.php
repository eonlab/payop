<?php

namespace Eonlab\Exceptions;

use Exception;
use Throwable;

/**
 * @author  : Uğur Müslim
 * @date    : 12.22.2021 21:00
 * @mail    : <ugurmuslim@bynogame.com>
 *
 * @package BNG\Exceptions;
 */
class ServiceException extends Exception
{
    /**
     * ServiceException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Service Not Respond Correctly", $code = 0xF362B, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
