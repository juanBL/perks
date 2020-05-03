<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Domain;

interface PerkRepository
{
    public function save(Perk $perk): void;

    public function searchAll(): array;
}
