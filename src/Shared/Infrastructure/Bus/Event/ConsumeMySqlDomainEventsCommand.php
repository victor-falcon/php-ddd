<?php

declare(strict_types=1);

namespace Cal\Shared\Infrastructure\Bus\Event;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ConsumeMySqlDomainEventsCommand extends Command
{
    const QUANTITY_ARGUMENT = 'quantity';
    protected static $defaultName = 'cal:domain-events:mysql:consume';
    private MySqlDoctrineEventConsumer $consumer;

    public function __construct(MySqlDoctrineEventConsumer $consumer)
    {
        parent::__construct();
        $this->consumer = $consumer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Consume events stored in MySql')
            ->addArgument(
                self::QUANTITY_ARGUMENT,
                InputArgument::OPTIONAL,
                'Quantity of events processed',
                100
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $quantity = (int) $input->getArgument(self::QUANTITY_ARGUMENT);
        $events = $this->consumer->getEventsToConsume($quantity);

        foreach ($events as $event) {
            try {
                $this->consumer->consume($event);
            } catch (\RuntimeException $exception) {
                $io->error($exception->getMessage());
            }
        }
    }
}
