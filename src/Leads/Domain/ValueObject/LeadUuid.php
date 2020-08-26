<?php declare(strict_types=1);

namespace Cal\Leads\Domain\ValueObject;

use Cal\Shared\Domain\ValueObject\Uuid;
use phpDocumentor\Reflection\Types\This;

class LeadUuid extends Uuid
{
    public static function random(): self
    {
        return new self(self::generate());
    }
}