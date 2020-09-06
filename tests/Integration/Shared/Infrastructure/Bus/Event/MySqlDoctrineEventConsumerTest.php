<?php

declare(strict_types=1);

namespace App\Tests\Integration\Shared\Infrastructure\Bus\Event;

use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Cal\Leads\Domain\Event\LeadCreatedEvent;
use Cal\Leads\Domain\Lead;
use Cal\Shared\Domain\Bus\Event\Event;
use Cal\Shared\Domain\Utils;
use Cal\Shared\Infrastructure\Bus\Event\MySqlDoctrineEventBus;
use Cal\Shared\Infrastructure\Bus\Event\MySqlDoctrineEventConsumer;
use Doctrine\ORM\EntityManagerInterface;

class MySqlDoctrineEventConsumerTest extends InfrastructureTestCase
{
    private MySqlDoctrineEventBus $eventBus;
    private \Doctrine\DBAL\Connection $connection;
    private MySqlDoctrineEventConsumer $eventConsumer;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->get(EntityManagerInterface::class);
        $this->connection = $entityManager->getConnection();

        /** @var MySqlDoctrineEventBus $bus */
        $bus = $this->get(MySqlDoctrineEventBus::class);
        $this->eventBus = $bus;

        /** @var MySqlDoctrineEventConsumer $consumer */
        $consumer = $this->get(MySqlDoctrineEventConsumer::class);
        $this->eventConsumer = $consumer;
    }

    public function test_it_get_expected_events_to_consume(): void
    {
        $this->eventBus->publish(new LeadCreatedEvent(LeadMother::random()));

        $events = $this->eventConsumer->getEventsToConsume();
        $this->assertEquals(1, count($events));
        $this->assertInstanceOf(LeadCreatedEvent::class, $events[0]);
    }

    public function test_it_consume_events(): void
    {
        $lead = LeadMother::random();
        $event = new LeadCreatedEvent($lead);

        $this->publishAndConsumeEvent($event);

        $eventLogged = $this->connection->executeQuery('select * from events_log')->fetch(0);
        $this->assertEquals(LeadCreatedEvent::eventName(), $eventLogged['name']);

        $resultLead = Lead::fromArray(Utils::jsonDecode($eventLogged['body']));
        $this->assertEquals($lead->name()->value(), $resultLead->name()->value());
    }

    protected function publishAndConsumeEvent(Event $event): void
    {
        $this->eventBus->publish($event);
        $events = $this->eventConsumer->getEventsToConsume();
        $this->eventConsumer->consume(...$events);
    }
}
