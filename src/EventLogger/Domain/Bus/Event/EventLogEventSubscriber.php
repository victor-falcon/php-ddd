<?php

declare(strict_types=1);

namespace Cal\EventLogger\Domain\Bus\Event;

use Cal\Shared\Domain\Bus\Event\Event;
use Cal\Shared\Domain\Bus\Event\EventSubscriber;

class EventLogEventSubscriber implements EventSubscriber
{
    public static function subscribedTo(): array
    {
        return [Event::class];
    }

    public function __invoke(Event $event): void
    {
        // todo: log event in database
    }
}