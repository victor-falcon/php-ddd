<?php

declare(strict_types=1);

namespace App\Tests\Unit\EventLogger\Domain;

use App\Tests\Shared\Domain\Mother\EventLogger\EventLogMother;
use App\Tests\Unit\EventLogger\EventLoggerTestCase;
use Cal\EventLogger\Domain\EventLog;

class EventLogTest extends EventLoggerTestCase
{
    public function test_it_is_created_from_an_array()
    {
        $event = EventLogMother::random();
        $fromArray = EventLog::fromArray($event->toArray());

        $this->assertTrue($this->areSimilar($event->toArray(), $fromArray->toArray()));
    }
}
