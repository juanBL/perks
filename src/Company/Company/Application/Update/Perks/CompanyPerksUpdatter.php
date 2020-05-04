<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Update\Perks;

use Perks\Company\Company\Application\FindById\CompanyByIdFinder;
use Perks\Company\Company\Domain\CompanyPerks;
use Perks\Company\Company\Domain\CompanyRepository;
use Perks\Company\Shared\Domain\Companies\CompanyId;

final class CompanyPerksUpdatter
{
    private CompanyRepository $repository;
    private CompanyByIdFinder $finder;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
        $this->finder     = new CompanyByIdFinder($repository);
    }

    public function __invoke(CompanyId $id, CompanyPerks $perks): void
    {
        $company = $this->finder->__invoke($id);
        $company->updatePerks($perks);
        $this->repository->save($company);
    }
}
