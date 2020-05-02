<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application;

use Perks\Shared\Domain\Bus\Query\Response;

final class CompanyResponse implements Response
{
    private string $id;
    private string $name;
    private string $logo;
    private int    $numberEmployees;
    private array  $perks;

    public function __construct(string $id, string $name, string $logo, int $numberEmployees, array $perks)
    {
        $this->id              = $id;
        $this->name            = $name;
        $this->logo            = $logo;
        $this->numberEmployees = $numberEmployees;
        $this->perks           = $perks;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function logo(): string
    {
        return $this->logo;
    }

    public function numberEmployees(): int
    {
        return $this->numberEmployees;
    }

    public function perks(): array
    {
        return $this->perks;
    }
}
