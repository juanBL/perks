<?php

declare(strict_types=1);

namespace Perks\Company\Company\Infrastructure\Persistence;

use Perks\Company\Company\Domain\Company;
use Perks\Company\Company\Domain\CompanyRepository;
use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCompanyRepository extends DoctrineRepository implements CompanyRepository
{
    public function save(Company $company): void
    {
        $this->persist($company);
    }

    public function search(CompanyId $id): ?Company
    {
        return $this->repository(Company::class)->find($id);
    }
}
