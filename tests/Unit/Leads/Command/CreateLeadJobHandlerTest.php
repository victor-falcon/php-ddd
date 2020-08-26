<?php declare(strict_types=1);

namespace App\Tests\Unit\Leads\Command;

use Cal\Leads\Command\CreateLeadJob;
use Cal\Leads\Command\CreateLeadJobHandler;
use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\LeadEmail;
use Cal\Leads\Domain\LeadName;
use Cal\Leads\Repository\LeadRepository;
use PHPUnit\Framework\TestCase;

class CreateLeadJobHandlerTest extends TestCase
{
    private \PHPUnit\Framework\MockObject\MockObject $repository;
    private CreateLeadJobHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->repository = $this->createMock(LeadRepository::class);
        $this->handler = new CreateLeadJobHandler($this->repository);
    }

    public function test_it_create_a_lead()
    {
        $name = 'any name';
        $email = 'any@email.com';

        $job = new CreateLeadJob($name, $email);

        $this->repository->expects(self::once())->method('save')
            ->with(
                new Lead(new LeadName($name), new LeadEmail($email))
            );

        ($this->handler)($job);
    }
}
