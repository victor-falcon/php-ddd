<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Behat;

use App\Kernel;
use App\Tests\Shared\Infrastructure\Doctrine\DatabaseArranger;
use Behat\Behat\Context\Context;
use Behat\Testwork\Hook\Scope\AfterSuiteScope;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DatabaseContext implements Context
{
    /** @BeforeSuite */
    public static function beforeSuite(BeforeSuiteScope $scope): void
    {
        self::getDatabaseArranger()->beforeClass();
    }

    /** @AfterSuite */
    public static function afterSuite(AfterSuiteScope $scope): void
    {
        self::getDatabaseArranger()->afterClass();
    }

    protected static function getDatabaseArranger(): DatabaseArranger
    {
        /** @var DatabaseArranger $databaseArranger */
        $databaseArranger = self::getContainer()->get(DatabaseArranger::class);

        return $databaseArranger;
    }

    /** @BeforeScenario */
    public function beforeScenario(): void
    {
        self::getDatabaseArranger()->beforeTest();
    }

    private static function getContainer(): ContainerInterface
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();

        return $kernel->getContainer();
    }
}
