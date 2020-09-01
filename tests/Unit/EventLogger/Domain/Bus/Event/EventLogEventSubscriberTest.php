<?php

declare(strict_types=1);

namespace App\Tests\Unit\EventLogger\Domain\Bus\Event;

use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use App\Tests\Unit\EventLogger\EventLoggerTestCase;
use Cal\EventLogger\Domain\Bus\Event\EventLogEventSubscriber;
use Cal\EventLogger\Domain\EventLog;
use Cal\Leads\Domain\Event\LeadCreatedEvent;
use Cal\Shared\Domain\Bus\Event\Event;

class EventLogEventSubscriberTest extends EventLoggerTestCase
{
    private EventLogEventSubscriber $eventSubscriber;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventSubscriber = new EventLogEventSubscriber($this->repository());
    }

    public function test_it_save_an_event(): void
    {
        $event = new LeadCreatedEvent(LeadMother::random());

        $this->shouldSave(EventLog::createFromEvent($event));

        ($this->eventSubscriber)($event);
    }

    public function test_it_is_subscribed_to_expected_events(): void
    {
        $this->assertEquals([Event::class], $this->eventSubscriber->subscribedTo());
    }
}
