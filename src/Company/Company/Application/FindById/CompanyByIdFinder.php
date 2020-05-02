<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\FindById;

use Perks\Company\Company\Domain\Company;
use Perks\Company\Company\Domain\CompanyNotExist;
use Perks\Company\Company\Domain\CompanyRepository;
use Perks\Company\Shared\Domain\Companies\CompanyId;

final class CompanyByIdFinder
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CompanyId $companyId): Company
    {
        $company = $this->repository->search($companyId);
        if ($company === null) {
            throw new CompanyNotExist($companyId);
        }

        return $company;
    }
}
