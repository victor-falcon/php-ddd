<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Behat;

use App\Tests\Shared\Infrastructure\Doctrine\DatabaseCleaner;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseContext implements Context
{
    private EntityManagerInterface $entityManager;
    private DatabaseCleaner $databaseCleaner;

    public function __construct(EntityManagerInterface $entityManager, DatabaseCleaner $databaseCleaner)
    {
        $this->entityManager = $entityManager;
        $this->databaseCleaner = $databaseCleaner;
    }

    /** @BeforeScenario */
    private function clearData(): void
    {
        $this->databaseCleaner->clear($this->entityManager);
    }
}