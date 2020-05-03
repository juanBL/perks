<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application;

use Perks\Shared\Domain\Bus\Query\Response;

final class PerksResponse implements Response
{
    private array $perks;

    public function __construct(PerkResponse ...$perks)
    {
        $this->perks = $perks;
    }

    public function perks(): array
    {
        return $this->perks;
    }
}
