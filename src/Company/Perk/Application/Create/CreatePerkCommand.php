<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application\Create;

use Perks\Shared\Domain\Bus\Command\Command;

final class CreatePerkCommand implements Command
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
