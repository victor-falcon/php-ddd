<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\Bus\Event;

interface EventBus
{
    public function publish(Event ...$events): void;
}
