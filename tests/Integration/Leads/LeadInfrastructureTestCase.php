<?php declare(strict_types=1);

namespace App\Tests\Integration\Leads;

use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Cal\Leads\Infrastructure\Persistence\DoctrineLeadRepository;
use Cal\Leads\Repository\LeadRepository;

class LeadInfrastructureTestCase extends InfrastructureTestCase
{
    protected LeadRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = parent::$container->get(DoctrineLeadRepository::class);
    }
}