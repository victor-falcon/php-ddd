<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\Repository\Exceptions;

use Throwable;

class NotFoundException extends \Exception
{
    public function __construct(string $class)
    {
        $message = sprintf('Not found entity of class %s', $class);
        parent::__construct($message, 0, null);
    }
}
