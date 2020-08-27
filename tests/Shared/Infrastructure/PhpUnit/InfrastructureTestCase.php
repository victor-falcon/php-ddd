<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\PhpUnit;

use App\Kernel;
use App\Tests\Shared\Infrastructure\Doctrine\DatabaseCleaner;
use Cal\Leads\Infrastructure\Persistence\DoctrineLeadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class InfrastructureTestCase extends KernelTestCase
{
    private DatabaseCleaner $clearDatabase;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
         $_SERVER['KERNEL_CLASS'] = Kernel::class;
        self::bootKernel(['environment' => 'test']);
        parent::setUp();

        $this->entityManager = self::$container->get(EntityManagerInterface::class);
        $this->clearDatabase = self::$container->get(DatabaseCleaner::class);
        $this->clearDatabase->clear($this->entityManager);
    }
}