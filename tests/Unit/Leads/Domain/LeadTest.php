<?php

declare(strict_types=1);

namespace App\Tests\Unit\Leads\Domain;

use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use App\Tests\Unit\Leads\LeadTestCase;
use Cal\Leads\Domain\Lead;

class LeadTest extends LeadTestCase
{
    public function test_it_is_created_from_an_array(): void
    {
        $lead = LeadMother::random();
        $fromArray = Lead::fromArray($lead->toArray());

        $this->assertTrue($this->areSimilar($lead->toArray(), $fromArray->toArray()));
    }
}
