<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\Mother\Lead;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Faker\Factory;

final class LeadMother
{
    public static function with(array $params): Lead
    {
        $faker = Factory::create();

        return new Lead(
            isset($params['uuid']) ? new LeadUuid($params['uuid']) : new LeadUuid($faker->uuid),
            new LeadName($params['name'] ?? null),
            new LeadEmail($params['email'])
        );
    }

    public static function random(): Lead
    {
        $faker = Factory::create();

        return new Lead(
            new LeadUuid($faker->uuid),
            new LeadName($faker->name),
            new LeadEmail($faker->email)
        );
    }
}
