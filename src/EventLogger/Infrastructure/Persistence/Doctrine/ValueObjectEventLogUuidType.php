<?php

declare(strict_types=1);

namespace Cal\EventLogger\Infrastructure\Persistence\Doctrine;

use Cal\EventLogger\Domain\ValueObject\EventLogUuid;
use Cal\Shared\Infrastructure\Persistence\Doctrine\UuidType;

class ValueObjectEventLogUuidType extends UuidType
{
    protected function typeClassName(): string
    {
        return EventLogUuid::class;
    }
}
