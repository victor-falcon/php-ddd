<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Doctrine;

interface DatabaseArrangerInterface
{
    public function beforeClass(): void;

    public function afterClass(): void;

    public function beforeTest(): void;

    public function afterTest(): void;
}
