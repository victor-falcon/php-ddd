<?php declare(strict_types=1);

namespace Cal\Leads\Domain;

use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Cal\Shared\Domain\Aggregate\AggregateRoot;

class Lead extends AggregateRoot
{
    private LeadUuid $uuid;
    private LeadName $name;
    private LeadEmail $email;

    public function __construct(LeadUuid $uuid, LeadName $name, LeadEmail $email)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
    }

    public function uuid(): LeadUuid
    {
        return $this->uuid;
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
