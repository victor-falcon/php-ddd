<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\Mother\Lead;

use Cal\Leads\Domain\Event\LeadCreatedEvent;
use Cal\Leads\Domain\Lead;

class LeadCreatedEventMother
{
    static public function fromLead(Lead $lead): LeadCreatedEvent
    {
        return new LeadCreatedEvent(
            $lead
        );
    }
}