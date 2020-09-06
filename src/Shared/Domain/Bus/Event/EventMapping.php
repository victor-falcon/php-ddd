<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\Bus\Event;

use Cal\Shared\Domain\Exception\EventMappingException;
use function Lambdish\Phunctional\reindex;

final class EventMapping
{
    private array $mapping;

    public function __construct(array $mapping)
    {
        $this->mapping = reindex(fn (string $class) => ($class)::eventName(), $mapping);
    }

    public function for(string $name)
    {
        throw_unless(
            isset($this->mapping[$name]),
            new EventMappingException(sprintf('No event class mapped for <%s>', $name))
        );

        return $this->mapping[$name];
    }
}
