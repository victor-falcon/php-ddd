<?php declare(strict_types=1);

namespace Cal\Leads\Domain\ValueObject;

use Cal\Shared\Domain\ValueObject\CreatedAt;
use Carbon\Carbon;

final class LeadCreatedAt extends CreatedAt
{
    protected \DateTime $date;

    public function __construct(\DateTime $date = null)
    {
        if (!$date instanceof Carbon && null !== $date) {
            $date = Carbon::instance($date);
        }

        $this->date = $date ?? Carbon::now();
    }

    public function date(): Carbon
    {
        return $this->date;
    }
}