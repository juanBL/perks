<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Update\Perks;

use Perks\Shared\Domain\Bus\Command\Command;

final class UpdateCompanyPerksCommand implements Command
{
    private string  $id;
    private array   $perks;

    public function __construct(string $id, array $perks)
    {
        $this->id    = $id;
        $this->perks = $perks;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function perks(): array
    {
        return $this->perks;
    }
}
