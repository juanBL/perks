<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Update\Deactivate;

use Perks\Company\Company\Application\FindById\CompanyByIdFinder;
use Perks\Company\Company\Domain\CompanyRepository;
use Perks\Company\Shared\Domain\Companies\CompanyId;

final class CompanyDeactivator
{
    private CompanyRepository $repository;
    private CompanyByIdFinder $finder;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
        $this->finder     = new CompanyByIdFinder($repository);
    }

    public function __invoke(CompanyId $id): void
    {
        $company = $this->finder->__invoke($id);
        $company->deactive();
        $this->repository->save($company);
    }
}
