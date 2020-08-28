<?php declare(strict_types=1);

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
        return new Lead(
            isset($params['uuid']) ? new LeadUuid($params['uuid']) : LeadUuid::random(),
            new LeadName($params['name'] ?? null),
            new LeadEmail($params['email'])
        );
    }

    public static function random()
    {
        $faker = Factory::create();

        return new Lead(
            LeadUuid::random(),
            new LeadName($faker->name),
            new LeadEmail($faker->email)
        );
    }
}