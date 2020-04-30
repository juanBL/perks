<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Create;

use Perks\Company\Company\Domain\Company;
use Perks\Company\Company\Domain\CompanyLogo;
use Perks\Company\Company\Domain\CompanyName;
use Perks\Company\Company\Domain\CompanyNumberEmployees;
use Perks\Company\Company\Domain\CompanyPerks;
use Perks\Company\Company\Domain\CompanyRepository;
use Perks\Company\Shared\Domain\Companies\CompanyId;

final class CompanyCreator
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        CompanyId $id,
        CompanyName $name,
        CompanyLogo $logo,
        CompanyNumberEmployees $numberEmployees,
        CompanyPerks $perks
    ): void {
        $company = Company::create($id, $name, $logo, $numberEmployees, $perks);

        $this->repository->save($company);
    }
}
