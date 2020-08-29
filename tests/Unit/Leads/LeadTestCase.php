<?php

declare(strict_types=1);

namespace App\Tests\Unit\Leads;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Repository\LeadRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

abstract class LeadTestCase extends TestCase
{
    /** @var MockObject */
    protected $repository;

    protected function shouldSave(Lead $lead): void
    {
        $this->repository->expects(self::any())->method('save')
            ->with($this->callback(function (Lead $a) use ($lead) {
                return $this->areSimilar($a, $lead);
            }));
    }

    private function areSimilar(Lead $a, Lead $b): bool
    {
        return $a->name()->value() === $b->name()->value()
            && $a->email()->value() === $b->email()->value();
    }
}
