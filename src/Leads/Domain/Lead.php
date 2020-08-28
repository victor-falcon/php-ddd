<?php declare(strict_types=1);

namespace Cal\Leads\Domain;

use Cal\Leads\Domain\ValueObject\LeadCreatedAt;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Cal\Shared\Domain\Aggregate\AggregateRoot;

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
}
