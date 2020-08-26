<?php declare(strict_types=1);

namespace Cal\Leads\Infrastructure\Persistence;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Repository\LeadRepository;
use Cal\Shared\Infrastructure\Persistence\DoctrineRepository;

class DoctrineLeadRepository extends DoctrineRepository implements LeadRepository
{
    public function save(Lead $lead): void
    {
        $this->persist($lead);
    }
}