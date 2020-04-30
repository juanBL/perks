<?php

declare(strict_types=1);

namespace Perks\Company\Company\Domain;

use Perks\Company\Shared\Domain\Companies\CompanyId;

interface CompanyRepository
{
    public function save(Company $company): void;

    public function search(CompanyId $id): ?Company;

}
