<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Domain;

use Perks\Company\Shared\Domain\Perks\PerkId;

final class Perk
{
    private PerkId   $id;
    private PerkName $name;

    public function __construct(PerkId $id, PerkName $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function id(): PerkId
    {
        return $this->id;
    }

    public function name(): PerkName
    {
        return $this->name;
    }
}
