<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\Bus\Event;

interface EventSubscriber
{
    public static function subscribedTo(): array;
}
