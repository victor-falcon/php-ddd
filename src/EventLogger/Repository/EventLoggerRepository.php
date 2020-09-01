<?php

declare(strict_types=1);

namespace Cal\EventLogger\Repository;

use Cal\EventLogger\Domain\EventLog;

interface EventLoggerRepository
{
    public function save(EventLog $eventLog): void;
}
