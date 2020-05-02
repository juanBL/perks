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
    private CompanyActive          $active;

    public function __construct(
        CompanyId $id,
        CompanyName $name,
        CompanyLogo $logo,
        CompanyNumberEmployees $numberEmployees,
        CompanyPerks $perks,
        CompanyActive $active
    ) {
        $this->id              = $id;
        $this->name            = $name;
        $this->logo            = $logo;
        $this->numberEmployees = $numberEmployees;
        $this->perks           = $perks;
        $this->active          = $active;
    }

    public static function create(
        CompanyId $id,
        CompanyName $name,
        CompanyLogo $logo,
        CompanyNumberEmployees $numberEmployees,
        CompanyPerks $perks,
        CompanyActive $active
    ): self {
        return new self(
            $id, $name, $logo, $numberEmployees, $perks, $active
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

    public function active(): CompanyActive
    {
        return $this->active;
    }

    public function deactive(): CompanyActive
    {
        return $this->active = new CompanyActive(false);
    }
}
