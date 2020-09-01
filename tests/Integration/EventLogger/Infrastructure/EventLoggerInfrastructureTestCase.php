<?php

declare(strict_types=1);

namespace App\Tests\Integration\EventLogger\Infrastructure;

use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Cal\EventLogger\Infrastructure\Persistence\DoctrineEventLoggerRepository;

class EventLoggerInfrastructureTestCase extends InfrastructureTestCase
{
    protected DoctrineEventLoggerRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var DoctrineEventLoggerRepository $repository */
        $repository = $this->get(DoctrineEventLoggerRepository::class);
        $this->repository = $repository;
    }
}
