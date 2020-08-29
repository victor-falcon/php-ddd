<?php

declare(strict_types=1);

namespace Cal\Shared\Infrastructure\Bus\Exception;

use Cal\Shared\Domain\Bus\Command\Command;

class CommandNotRegisteredError extends \Exception
{
    public function __construct(Command $query)
    {
        $message = sprintf('Job with class %s has no handler registered', get_class($query));

        parent::__construct($message);
    }
}
