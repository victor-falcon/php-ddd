<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\ValueObject;

use Cal\Shared\Domain\Utils;
use Carbon\Carbon;

class CreatedAt
{
    protected \DateTime $date;

    public function __construct(\DateTime $date = null)
    {
        if (! $date instanceof Carbon && null !== $date) {
            $date = Carbon::instance($date);
        }

        $this->date = $date ?? Carbon::now();
    }

    public function date(): Carbon
    {
        return $this->date;
    }

    public function value(): string
    {
        return Utils::dateToString($this->date());
    }
}
