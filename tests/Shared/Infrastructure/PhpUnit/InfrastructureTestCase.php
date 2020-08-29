<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\PhpUnit;

use App\Tests\Shared\Infrastructure\Doctrine\DatabaseArrangerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class InfrastructureTestCase extends KernelTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::databaseArranger()->beforeClass();
    }

    protected function setUp(): void
    {
        parent::setUp();
        self::databaseArranger()->beforeTest();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::databaseArranger()->afterClass();
    }

    public function get(string $class): ?object
    {
        self::bootKernel(['environment' => 'test']);

        return self::$container->get($class);
    }

    protected static function databaseArranger(): DatabaseArrangerInterface
    {
        self::bootKernel(['environment' => 'test']);

        /** @var DatabaseArrangerInterface $database */
        $database = self::$container->get(DatabaseArrangerInterface::class);

        return $database;
    }
}
