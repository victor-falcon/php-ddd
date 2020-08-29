<?php

declare(strict_types=1);

namespace Cal\Leads\Infrastructure\Persistence;

use Cal\Leads\Domain\Exception\DuplicatedLeadException;
use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Repository\LeadRepository;
use Cal\Shared\Domain\Repository\Exceptions\NotFoundException;
use Cal\Shared\Infrastructure\Persistence\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Lead findOneBy(array $parameters, array $sortBy = null)
 */
class DoctrineLeadRepository extends DoctrineRepository implements LeadRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Lead::class);
    }

    public function save(Lead $lead): void
    {
        try {
            $this->findByEmail($lead->email());
            throw new DuplicatedLeadException();
        } catch (NotFoundException $e) {
            $this->persist($lead);
        }
    }

    public function findByEmail(LeadEmail $email): Lead
    {
        return $this->findOneBy(['email.email' => $email->value()]);
    }
}
