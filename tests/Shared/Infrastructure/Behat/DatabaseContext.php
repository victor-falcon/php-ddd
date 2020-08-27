<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Behat;

use App\Kernel;
use App\Tests\Shared\Infrastructure\Doctrine\DatabaseArranger;
use Behat\Behat\Context\Context;
use Behat\Testwork\Hook\Scope\AfterSuiteScope;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;

class DatabaseContext implements Context
{
    /** @BeforeSuite */
    public static function beforeSuite(BeforeSuiteScope $scope)
    {
        self::getContainer()->get(DatabaseArranger::class)->beforeClass();
    }

    /** @AfterSuite */
    public static function afterSuite(AfterSuiteScope $scope)
    {
        self::getContainer()->get(DatabaseArranger::class)->afterClass();
    }

    /** @BeforeScenario */
    public function beforeScenario()
    {
        self::getContainer()->get(DatabaseArranger::class)->beforeTest();
    }

    private static function getContainer()
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();

        return $kernel->getContainer();
    }
}