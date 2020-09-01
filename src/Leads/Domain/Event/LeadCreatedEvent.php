<?php

declare(strict_types=1);

namespace Cal\Leads\Domain\Event;

use Cal\Leads\Domain\Lead;
use Cal\Shared\Domain\Bus\Event\Event;

class LeadCreatedEvent extends Event
{
    private Lead $lead;

    public function __construct(
        Lead $lead,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->lead = $lead;
        parent::__construct($lead->id()->value(), $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'leads.domain.lead.v1.create';
    }

    public function toPrimitives(): array
    {
        return $this->lead->toArray();
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): Event {
        return new self(
            Lead::fromArray($body),
            $eventId,
            $occurredOn
        );
    }
}
