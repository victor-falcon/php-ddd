<?php

declare(strict_types=1);

namespace App\Tests\Unit\Leads\Domain\Event;

use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use App\Tests\Unit\Leads\LeadTestCase;
use Cal\Leads\Domain\Event\LeadCreatedEvent;
use Cal\Leads\Domain\Lead;
use Cal\Shared\Domain\Utils;
use Carbon\Carbon;
use Faker\Factory;

class LeadCreatedEventTest extends LeadTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow();
    }

    public function test_event_name(): void
    {
        $event = $this->getEvent();

        $this->assertEquals('leads.domain.lead.v1.create', $event->eventName());
    }

    public function test_it_returns_expected_primitive(): void
    {
        $lead = LeadMother::random();
        $event = $this->getEvent($lead);

        $this->assertEquals($lead->toArray(), $event->toPrimitives());
    }

    public function test_it_is_created_as_expected_from_primitive(): void
    {
        $lead = LeadMother::random();
        $event = $this->getEvent($lead);
        $fromPrimitive = LeadCreatedEvent::fromPrimitives(
            $event->aggregateId(),
            $event->toPrimitives(),
            $event->eventId(),
            $event->occurredOn()
        );

        $this->assertEquals($fromPrimitive->toPrimitives(), $event->toPrimitives());
    }

    private function getEvent(Lead $lead = null): LeadCreatedEvent
    {
        $faker = Factory::create();

        return new LeadCreatedEvent(
            $lead ?? LeadMother::random(),
            $faker->uuid,
            Utils::dateToString(Carbon::now())
        );
    }
}
