<?php declare(strict_types=1);

namespace App\Tests\Unit\Leads;

use Cal\Leads\Domain\Lead;
use PHPUnit\Framework\TestCase;

class LeadTestCase extends TestCase
{
    protected \PHPUnit\Framework\MockObject\MockObject $repository;

    protected function assertItsSaved(Lead $lead)
    {
        $this->repository->expects($this->once())->method('save')
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