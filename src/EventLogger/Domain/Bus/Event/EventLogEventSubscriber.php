<?php

declare(strict_types=1);

namespace Cal\EventLogger\Domain\Bus\Event;

use Cal\EventLogger\Domain\EventLog;
use Cal\EventLogger\Repository\EventLoggerRepository;
use Cal\Shared\Domain\Bus\Event\Event;
use Cal\Shared\Domain\Bus\Event\EventSubscriber;

class EventLogEventSubscriber implements EventSubscriber
{
    private EventLoggerRepository $repository;

    public function __construct(EventLoggerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Event $event): void
    {
        $eventLog = EventLog::createFromEvent($event);
        $this->repository->save($eventLog);
    }

    public static function subscribedTo(): array
    {
        return [Event::class];
    }
}