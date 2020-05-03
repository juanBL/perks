<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application;

use Perks\Shared\Domain\Bus\Query\Response;

final class PerkResponse implements Response
{
    private string $id;
    private string $name;

    public function __construct(string $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
