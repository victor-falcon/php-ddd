<?php

declare(strict_types=1);

namespace App\Tests\Unit\Leads\Command;

use App\Tests\Shared\Domain\Mother\Lead\LeadCreatedEventMother;
use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use App\Tests\Unit\Leads\LeadTestCase;
use Cal\Leads\Command\CreateLeadCommand;
use Cal\Leads\Command\CreateLeadCommandHandler;
use Carbon\Carbon;
use Faker\Factory;

class CreateLeadCommandHandlerTest extends LeadTestCase
{
    private CreateLeadCommandHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::now());
        $this->handler = new CreateLeadCommandHandler(
            $this->repository(),
            $this->eventBus()
        );
    }

    public function test_it_create_a_lead(): void
    {
        $name = 'any name';
        $email = 'any@email.com';

        $lead = LeadMother::with(['name' => $name, 'email' => $email]);
        $event = LeadCreatedEventMother::fromLead($lead);

        $this->shouldSave($lead);
        $this->shouldPublishEvent($event);

        ($this->handler)(new CreateLeadCommand($name, $email));

        $this->assertTrue(true); // No exception thrown
    }
}
