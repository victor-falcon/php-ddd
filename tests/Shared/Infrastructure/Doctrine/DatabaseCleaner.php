<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

interface DatabaseCleaner
{
    public function clear(EntityManagerInterface $entityManager): void;
}
