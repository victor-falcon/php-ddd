<?php declare(strict_types=1);

namespace Cal\Leads\Infrastructure\Persistence\Doctrine;

use Cal\Leads\Domain\LeadUuid;
use Cal\Shared\Infrastructure\Persistence\Doctrine\UuidType;

class LeadUuidType extends UuidType
{
    protected function typeClassName(): string
    {
        return LeadUuid::class;
    }
}