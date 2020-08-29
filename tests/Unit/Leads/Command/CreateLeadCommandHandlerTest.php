<?php

declare(strict_types=1);

namespace App\Tests\Unit\Leads\Command;

use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use App\Tests\Unit\Leads\LeadTestCase;
use Cal\Leads\Command\CreateLeadCommand;
use Cal\Leads\Command\CreateLeadCommandHandler;
use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Cal\Leads\Repository\LeadRepository;
use PHPUnit\Framework\TestCase;

class CreateLeadCommandHandlerTest extends LeadTestCase
{
    private CreateLeadCommandHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(LeadRepository::class);
        $this->handler = new CreateLeadCommandHandler($this->repository);
    }

    public function test_it_create_a_lead(): void
    {
        $name = 'any name';
        $email = 'any@email.com';

        $job = new CreateLeadCommand($name, $email);

        $this->shouldSave(LeadMother::with(['name' => $name, 'email' => $email]));

        ($this->handler)($job);

        $this->assertTrue(true);
    }
}
