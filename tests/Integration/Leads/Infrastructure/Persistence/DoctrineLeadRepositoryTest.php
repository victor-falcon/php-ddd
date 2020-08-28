<?php declare(strict_types=1);

namespace App\Tests\Integration\Leads\Infrastructure\Persistence;

use App\Tests\Integration\Leads\LeadInfrastructureTestCase;
use App\Tests\Shared\Domain\Mother\Lead\LeadMother;
use Cal\Leads\Domain\Exception\DuplicatedLeadException;

class DoctrineLeadRepositoryTest extends LeadInfrastructureTestCase
{
    public function test_save(): void
    {
        $lead = LeadMother::random();
        $this->repository->save($lead);
        $this->assertTrue(true);
    }

    public function test_save_with_null_name(): void
    {
        $lead = LeadMother::with(['name' => null, 'email' => 'any@email.com']);
        $this->repository->save($lead);
        $this->assertTrue(true);
    }

    public function test_that_email_its_unique(): void
    {
        $lead = LeadMother::random();
        $this->repository->save($lead);

        $this->expectException(DuplicatedLeadException::class);

        $sameEmailLead = LeadMother::with(['email' => $lead->email()->value()]);
        $this->repository->save($sameEmailLead);
    }
}
