<?php declare(strict_types=1);

namespace Cal\Leads\Command;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Cal\Leads\Repository\LeadRepository;
use Cal\Shared\Domain\Bus\Command\JobHandler;
use Cal\Shared\Domain\ValueObject\Uuid;

final class CreateLeadJobHandler implements JobHandler
{
    private LeadRepository $repository;

    public function __construct(LeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateLeadJob $command): Lead
    {
        $lead = new Lead(
            LeadUuid::random(),
            new LeadName($command->name()),
            new LeadEmail($command->email())
        );

        $this->repository->save($lead);

        return $lead;
    }
}
