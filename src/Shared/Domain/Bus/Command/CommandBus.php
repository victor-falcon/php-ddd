<?php declare(strict_types=1);

namespace Cal\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $job): void;
}