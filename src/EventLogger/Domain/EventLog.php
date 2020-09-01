<?php

declare(strict_types=1);

namespace Cal\EventLogger\Domain;

use Cal\EventLogger\Domain\ValueObject\EventLogAggregateId;
use Cal\EventLogger\Domain\ValueObject\EventLogBody;
use Cal\EventLogger\Domain\ValueObject\EventLogCreatedAt;
use Cal\EventLogger\Domain\ValueObject\EventLogName;
use Cal\EventLogger\Domain\ValueObject\EventLogUuid;
use Cal\Shared\Domain\Aggregate\AggregateRoot;

final class EventLog extends AggregateRoot
{
    public EventLogUuid $id;
    public EventLogAggregateId $aggregateId;
    public EventLogName $name;
    public EventLogBody $body;
    public EventLogCreatedAt $createdAt;

    public function __construct(
        EventLogUuid $id,
        EventLogAggregateId $aggregateId,
        EventLogName $name,
        EventLogBody $body,
        EventLogCreatedAt $createdAt = null
    ) {
        $this->id = $id;
        $this->aggregateId = $aggregateId;
        $this->name = $name;
        $this->body = $body;
        $this->createdAt = $createdAt ?? new EventLogCreatedAt();
    }

    public function id(): EventLogUuid
    {
        return $this->id;
    }

    public function aggregateId(): EventLogAggregateId
    {
        return $this->aggregateId;
    }

    public function name(): EventLogName
    {
        return $this->name;
    }

    public function body(): EventLogBody
    {
        return $this->body;
    }

    public function createdAt(): EventLogCreatedAt
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'aggregateId' => $this->aggregateId()->value(),
            'name' => $this->name()->value(),
            'body' => $this->body()->value(),
            'createdAt' => $this->createdAt()->value(),
        ];
    }

    public static function fromArray(array $parameters): self
    {
        return new self(
            new EventLogUuid($parameters['id']),
            new EventLogAggregateId($parameters['aggregateId']),
            new EventLogName($parameters['name']),
            new EventLogBody($parameters['body']),
            EventLogCreatedAt::formString($parameters['createdAt'])
        );
    }
}