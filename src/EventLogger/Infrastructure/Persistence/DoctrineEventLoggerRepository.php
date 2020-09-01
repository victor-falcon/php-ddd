<?php

declare(strict_types=1);

namespace Cal\EventLogger\Infrastructure\Persistence;

use Cal\EventLogger\Domain\EventLog;
use Cal\EventLogger\Repository\EventLoggerRepository;
use Cal\Shared\Infrastructure\Persistence\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineEventLoggerRepository extends DoctrineRepository implements EventLoggerRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, EventLog::class);
    }

    public function save(EventLog $eventLog): void
    {
        $this->persist($eventLog);
    }
}