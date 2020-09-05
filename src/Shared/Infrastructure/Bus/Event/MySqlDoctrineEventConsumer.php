<?php

declare(strict_types=1);

namespace Cal\Shared\Infrastructure\Bus\Event;

use Cal\Shared\Domain\Bus\Event\Event;
use Cal\Shared\Infrastructure\Bus\GetPipedHandlers;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class MySqlDoctrineEventConsumer
{
    private Connection $connection;
    private MessageBus $bus;

    public function __construct(iterable $commandHandlers, EntityManagerInterface $entityManager)
    {
        $this->connection = $entityManager->getConnection();
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(GetPipedHandlers::forPipedCallables($commandHandlers))
            ),
        ]);
    }

    public function consume(Event $event): void
    {
        try {
            $this->bus->dispatch($event);
        } catch (NoHandlerForMessageException $exception) {
        }
    }

    /** @return Event[] */
    public function getEventsToConsume(int $quantity): array
    {
        return $this->connection
            ->executeQuery("select * from events order by created_at limit $quantity")
            ->fetchAll(FetchMode::ASSOCIATIVE);
    }
}
