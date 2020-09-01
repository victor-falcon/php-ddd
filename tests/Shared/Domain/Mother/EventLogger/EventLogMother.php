<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\Mother\EventLogger;

use Cal\EventLogger\Domain\EventLog;
use Cal\EventLogger\Domain\ValueObject\EventLogAggregateId;
use Cal\EventLogger\Domain\ValueObject\EventLogBody;
use Cal\EventLogger\Domain\ValueObject\EventLogName;
use Cal\EventLogger\Domain\ValueObject\EventLogUuid;
use Faker\Factory;

final class EventLogMother
{
    public static function random(): EventLog
    {
        $faker = Factory::create();

        return new EventLog(
            new EventLogUuid($faker->uuid),
            new EventLogAggregateId($faker->uuid),
            new EventLogName('any.event.name.v1.fired'),
            new EventLogBody($faker->shuffleArray([
                $faker->name => $faker->name,
                'card' => $faker->creditCardNumber,
            ]))
        );
    }
}
