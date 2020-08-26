<?php declare(strict_types=1);

namespace Cal\Leads\Repository;

use Cal\Leads\Domain\Lead;

interface LeadRepository
{
    public function save(Lead $lead): void;
}
