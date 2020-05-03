<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Domain;

use Perks\Company\Shared\Domain\Perks\PerkId;
use Perks\Shared\Domain\Aggregate\AggregateRoot;

final class Perk extends AggregateRoot
{
    private PerkId   $id;
    private PerkName $name;

    public function __construct(PerkId $id, PerkName $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public static function create(PerkId $id, PerkName $name): self
    {
        return new self($id, $name);
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
