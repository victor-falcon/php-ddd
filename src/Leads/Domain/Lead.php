<?php

declare(strict_types=1);

namespace Cal\Leads\Domain;

use Cal\Leads\Domain\Event\LeadCreatedEvent;
use Cal\Leads\Domain\ValueObject\LeadCreatedAt;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Cal\Shared\Domain\Aggregate\AggregateRoot;
use Cal\Shared\Domain\Utils;

final class Lead extends AggregateRoot
{
    private LeadUuid $id;
    private LeadName $name;
    private LeadEmail $email;
    private LeadCreatedAt $createdAt;

    public function __construct(
        LeadUuid $id,
        LeadName $name,
        LeadEmail $email,
        LeadCreatedAt $createdAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt ?? new LeadCreatedAt();
    }

    public static function create(
        LeadUuid $id,
        LeadName $name,
        LeadEmail $email
    ): self {
        $lead = new self($id, $name, $email, new LeadCreatedAt);
        $lead->record(new LeadCreatedEvent($lead));

        return $lead;
    }

    public function id(): LeadUuid
    {
        return $this->id;
    }

    public function name(): LeadName
    {
        return $this->name;
    }

    public function email(): LeadEmail
    {
        return $this->email;
    }

    public function createdAt(): LeadCreatedAt
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'email' => $this->email()->value(),
            'createdAt' => $this->createdAt()->date(),
        ];
    }

    public static function fromArray(array $parameters): self
    {
        return new self(
            new LeadUuid($parameters['id']),
            new LeadName($parameters['name']),
            new LeadEmail($parameters['email']),
            LeadCreatedAt::formString($parameters['createdAt'])
        );
    }
}
