<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Shared\Infrastructure\PhpUnit;

use Perks\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use Perks\Tests\Shared\Infrastructure\Doctrine\DatabaseCleaner;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;

final class MoocEnvironmentArranger implements EnvironmentArranger
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function arrange(): void
    {
        apply(new DatabaseCleaner(), [$this->entityManager]);
    }

    public function close(): void
    {
    }
}
