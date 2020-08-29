<?php

declare(strict_types=1);

namespace Cal\Leads\Infrastructure\Persistence\Doctrine;

use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Shared\Infrastructure\Persistence\Doctrine\NullableStringType;

class ValueObjectLeadNameType extends NullableStringType
{
    protected function typeClassName(): string
    {
        return LeadName::class;
    }
}
