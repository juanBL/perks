<?php

declare(strict_types=1);

namespace Perks\Company\Company\Domain;

use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Shared\Domain\Aggregate\AggregateRoot;

final class Company extends AggregateRoot
{
    private CompanyId              $id;
    private CompanyName            $name;
    private CompanyLogo            $logo;
    private CompanyNumberEmployees $numberEmployees;
    private CompanyPerks           $perks;

    public function __construct(
        CompanyId $id,
        CompanyName $name,
        CompanyLogo $logo,
        CompanyNumberEmployees $numberEmployees,
        CompanyPerks $perks
    ) {
        $this->id              = $id;
        $this->name            = $name;
        $this->logo            = $logo;
        $this->numberEmployees = $numberEmployees;
        $this->perks           = $perks;
    }

    public static function create(
        CompanyId $id,
        CompanyName $name,
        CompanyLogo $logo,
        CompanyNumberEmployees $numberEmployees,
        CompanyPerks $perks
    ): self {
        return new self(
            $id, $name, $logo, $numberEmployees, $perks
        );
    }

    public function id(): CompanyId
    {
        return $this->id;
    }

    public function name(): CompanyName
    {
        return $this->name;
    }

    public function logo(): CompanyLogo
    {
        return $this->logo;
    }

    public function numberEmployees(): CompanyNumberEmployees
    {
        return $this->numberEmployees;
    }

    public function perks(): CompanyPerks
    {
        return $this->perks;
    }
}
