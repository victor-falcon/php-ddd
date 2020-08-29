<?php

declare(strict_types=1);

namespace App\Tests\Unit\Leads;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Repository\LeadRepository;
use Cal\Shared\Domain\Bus\Event\Event;
use Cal\Shared\Domain\Bus\Event\EventBus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

abstract class LeadTestCase extends TestCase
{
    /** @var MockObject */
    protected $repository;

    /** @var MockObject */
    protected $eventBus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->createMock(LeadRepository::class);
        $this->eventBus = $this->createMock(EventBus::class);
    }

    public function repository(): LeadRepository
    {
        /** @var LeadRepository $repository */
        $repository = $this->repository;

        return $repository;
    }

    public function eventBus(): EventBus
    {
        /** @var EventBus $bus */
        $bus = $this->eventBus;

        return $bus;
    }

    protected function shouldSave(Lead $lead): void
    {
        $this->repository->method('save')
            ->with($this->callback(function (Lead $a) use ($lead) {
                return $this->areSimilar($a->toArray(), $lead->toArray());
            }));
    }

    protected function shouldPublishEvent(Event $event): void
    {
        $this->eventBus->method('publish')
            ->with($this->callback(function (Event $e) use ($event) {
                return $this->areSimilar($e->toPrimitives(), $event->toPrimitives());
            }));
    }

    private function areSimilar(array $a, array $b): bool
    {
        return $a['name'] === $b['name']
            && $a['email'] === $b['email'];
    }
}
