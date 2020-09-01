<?php

declare(strict_types=1);

namespace App\Tests\Unit\EventLogger;

use Cal\EventLogger\Domain\EventLog;
use Cal\EventLogger\Repository\EventLoggerRepository;
use PHPStan\Testing\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class EventLoggerTestCase extends TestCase
{
    /** @var MockObject */
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->createMock(EventLoggerRepository::class);
    }

    public function repository(): EventLoggerRepository
    {
        /** @var EventLoggerRepository $repository */
        $repository = $this->repository;

        return $repository;
    }

    protected function shouldSave(EventLog $eventLog): void
    {
        $this->repository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function (EventLog $a) use ($eventLog) {
                return $this->areSimilar($a->toArray(), $eventLog->toArray());
            }));
    }

    protected function areSimilar(array $a, array $b): bool
    {
        return $a['aggregateId'] === $b['aggregateId']
            && $a['name'] === $b['name']
            && $a['body'] === $b['body'];
    }
}
