<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Doctrine;

use App\Kernel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class DatabaseArranger implements DatabaseArrangerInterface
{
    private DatabaseCleaner $cleaner;
    private Kernel $kernel;
    private EntityManagerInterface $entityManager;

    public function __construct(
        Kernel $kernel,
        DatabaseCleaner $cleaner,
        EntityManagerInterface $entityManager
    ) {
        $this->cleaner = $cleaner;
        $this->kernel = $kernel;
        $this->entityManager = $entityManager;
    }

    public function beforeClass(): void
    {
        $application = new Application($this->kernel);
        $application->setAutoExit(false);

        $application->run(new ArrayInput([
            'command' => 'doctrine:database:create',
        ]), new NullOutput());

        $application->run(new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
            '--no-interaction' => true,
        ]), new NullOutput());
    }

    public function afterClass(): void
    {
        $application = new Application($this->kernel);
        $application->setAutoExit(false);

        $application->run(new ArrayInput([
            'command' => 'doctrine:database:drop',
            '--force' => true,
            '--no-interaction' => true,
        ]), new NullOutput());
    }

    public function beforeTest(): void
    {
        $this->cleaner->clear($this->entityManager);
    }

    public function afterTest(): void
    {
    }

}