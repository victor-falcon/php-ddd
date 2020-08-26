<?php declare(strict_types=1);

namespace Cal\Leads\Domain;

use Cal\Shared\Domain\Aggregate\AggregateRoot;

class Lead extends AggregateRoot
{
    private LeadName $name;
    private LeadEmail $email;

    public function __construct(LeadName $name, LeadEmail $email)
    {
        $this->name = $name;
        $this->email = $email;
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
