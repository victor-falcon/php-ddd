<?php

declare(strict_types=1);

namespace Cal\EventLogger\Infrastructure\Persistence;

use Cal\EventLogger\Domain\EventLog;
use Cal\EventLogger\Repository\EventLoggerRepository;

class DoctrineEventLoggerRepository implements EventLoggerRepository
{
    public function save(EventLog $eventLog): void
    {
        // TODO: Implement save() method.
    }
}