<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\Exception;

use Throwable;

class InvalidJsonException extends \Exception
{
    public function __construct($json = "", $code = 0, Throwable $previous = null)
    {
        $message = sprintf("The string provided it's not a valid json: %s", $json);
        parent::__construct($message, $code, $previous);
    }
}