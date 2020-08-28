<?php declare(strict_types=1);

namespace Cal\Leads\Repository;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\ValueObject\LeadEmail;

interface LeadRepository
{
    public function save(Lead $lead): void;

    public function findByEmail(LeadEmail $email): Lead;
}
