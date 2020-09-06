<?php

declare(strict_types=1);

namespace Cal\Shared\Infrastructure\Bus\Event;

use Cal\Shared\Domain\Bus\Event\Event;
use Cal\Shared\Domain\Bus\Event\EventMapping;
use Cal\Shared\Domain\Utils;
use Cal\Shared\Infrastructure\Bus\GetPipedHandlers;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Doctrine\ORM\EntityManagerInterface;
use function Lambdish\Phunctional\map;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class MySqlDoctrineEventConsumer
{
    private Connection $connection;
    private MessageBus $bus;
    private EventMapping $eventBuilder;

    public function __construct(
        iterable $commandHandlers,
        EntityManagerInterface $entityManager,
        EventMapping $eventBuilder
    ) {
        $this->connection = $entityManager->getConnection();
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(GetPipedHandlers::forPipedCallables($commandHandlers))
            ),
        ]);
        $this->eventBuilder = $eventBuilder;
    }

    public function consume(Event $event): void
    {
        try {
            $this->bus->dispatch($event);
        } catch (NoHandlerForMessageException $exception) {
        }
    }

    /** @return Event[] */
    public function getEventsToConsume(int $quantity = 100): array
    {
        $rawEvents = $this->connection
            ->executeQuery("select * from events order by created_at limit $quantity")
            ->fetchAll(FetchMode::ASSOCIATIVE);

        return map($this->constructEvent(), $rawEvents);
    }

    private function constructEvent(): callable
    {
        return function (array $rawEvent): Event {
            $class = $this->eventBuilder->for($rawEvent['name']);

            return ($class)::fromPrimitives(
                $rawEvent['aggregate_id'],
                Utils::jsonDecode($rawEvent['body']),
                $rawEvent['id'],
                $rawEvent['created_at']
            );
        };
    }
}
