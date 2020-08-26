<?php declare(strict_types=1);

namespace Cal\Leads\Domain;

use Cal\Shared\Domain\ValueObject\Uuid;

class LeadUuid extends Uuid
{
    public static function random(): self
    {
        return new self(self::generate());
    }
}