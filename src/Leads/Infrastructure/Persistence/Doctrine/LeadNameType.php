<?php declare(strict_types=1);

namespace Cal\Leads\Infrastructure\Persistence\Doctrine;

use Cal\Leads\Domain\LeadName;
use Cal\Shared\Infrastructure\Persistence\Doctrine\NullableStringType;

class LeadNameType extends NullableStringType
{
    protected function typeClassName(): string
    {
        return LeadName::class;
    }
}