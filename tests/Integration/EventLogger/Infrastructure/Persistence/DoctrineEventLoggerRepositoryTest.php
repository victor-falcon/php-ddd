<?php

declare(strict_types=1);

namespace App\Tests\Integration\EventLogger\Infrastructure\Persistence;

use App\Tests\Integration\EventLogger\Infrastructure\EventLoggerInfrastructureTestCase;
use App\Tests\Shared\Domain\Mother\EventLogger\EventLogMother;

class DoctrineEventLoggerRepositoryTest extends EventLoggerInfrastructureTestCase
{
    public function test_save(): void
    {
        $eventLog = EventLogMother::random();
        $this->repository->save($eventLog);
        $this->assertTrue(true);
    }
}
