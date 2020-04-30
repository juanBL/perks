<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Create;

use Perks\Company\Company\Domain\Company;
use Perks\Company\Company\Domain\CompanyNotExist;
use Perks\Company\Company\Domain\CompanyRepository;
use Perks\Company\Shared\Domain\Companies\CompanyId;

final class CompanyFinder
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CompanyId $id): Company
    {
        $company = $this->repository->search($id);

        if (null === $company) {
            throw new CompanyNotExist($id);
        }

        return $company;
    }
}
