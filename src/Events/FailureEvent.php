<?php

declare(strict_types=1);

namespace Neo4j\Neo4jBundle\Events;

use Laudis\Neo4j\Databags\Statement;
use Laudis\Neo4j\Exception\Neo4jException;
use Symfony\Contracts\EventDispatcher\Event;

class FailureEvent extends Event
{
    public const EVENT_ID = 'neo4j.on_failure';

    protected bool $shouldThrowException = true;

    public function __construct(private string|null $alias, private Statement $statement, private Neo4jException $exception)
    {
    }

    public function getException(): Neo4jException
    {
        return $this->exception;
    }

    public function disableException(): void
    {
        $this->shouldThrowException = false;
    }

    public function shouldThrowException(): bool
    {
        return $this->shouldThrowException;
    }

    public function getAlias(): string|null
    {
        return $this->alias;
    }

    public function getStatement(): Statement
    {
        return $this->statement;
    }
}
