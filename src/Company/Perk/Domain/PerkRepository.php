<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Domain;

interface PerkRepository
{
    public function searchAll(): array;
}
