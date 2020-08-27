<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\PhpUnit;

use App\Kernel;
use App\Tests\Shared\Infrastructure\Doctrine\DatabaseCleaner;
use Cal\Leads\Repository\LeadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class InfrastructureTestCase extends KernelTestCase
{
    private DatabaseCleaner $clearDatabase;
    private EntityManagerInterface $entityManager;

   public static function setUpBeforeClass(): void
   {
       parent::setUpBeforeClass();

       self::bootKernel(['environment' => 'test']);

       // todo: extract all this to a TestEnvironmentArranger class
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);

        $application->run(new ArrayInput([
            'command' => 'doctrine:database:create',
        ]), new NullOutput());

        $application->run(new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
            '--no-interaction' => true,
        ]), new NullOutput());
   }

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel(['environment' => 'test']);

        // todo: this ClearDatabase should be called from TestEnvironmentArranger class
        $this->entityManager = self::$container->get(EntityManagerInterface::class);
        $this->clearDatabase = self::$container->get(DatabaseCleaner::class);
        $this->clearDatabase->clear($this->entityManager);

    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        self::bootKernel(['environment' => 'test']);

       // todo: extract all this to a TestEnvironmentArranger class
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);

        $application->run(new ArrayInput([
            'command' => 'doctrine:database:drop',
            '--force' => true,
            '--no-interaction' => true,
        ]), new NullOutput());
    }

    public function get(string $class)
    {
        self::bootKernel(['environment' => 'test']);
        return self::$container->get($class);
    }
}