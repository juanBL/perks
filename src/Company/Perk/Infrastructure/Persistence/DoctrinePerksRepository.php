<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Infrastructure\Persistence;

use Perks\Company\Perk\Domain\Perk;
use Perks\Company\Perk\Domain\PerkRepository;
use Perks\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrinePerksRepository extends DoctrineRepository implements PerkRepository
{
    public function searchAll(): array
    {
        return $this->repository(Perk::class)->findAll();
    }
}
