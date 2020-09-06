<?php

declare(strict_types=1);

namespace App\Tests\Integration\Shared\Domain\Bus\Event;

use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Cal\Leads\Domain\Event\LeadCreatedEvent;
use Cal\Shared\Domain\Bus\Event\EventMapping;
use Cal\Shared\Domain\Exception\EventMappingException;

class EventMappingTest extends InfrastructureTestCase
{
    private EventMapping $eventMapping;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var EventMapping $eventBuilder */
        $eventBuilder = $this->get(EventMapping::class);
        $this->eventMapping = $eventBuilder;
    }

    public function test_it_get_the_desire_event(): void
    {
        $result = $this->eventMapping->for('leads.domain.lead.v1.create');

        $this->assertEquals(LeadCreatedEvent::class, $result);
    }

    public function test_it_throws_expected_exception(): void
    {
        $this->expectException(EventMappingException::class);
        $this->expectDeprecationMessage('No event class mapped for <random>');

        $this->eventMapping->for('random');
    }
}
