<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\SearchAll;

use Perks\Company\Company\Application\CompaniesResponse;
use Perks\Company\Company\Application\CompanyResponse;
use Perks\Company\Company\Domain\Company;
use Perks\Company\Company\Domain\CompanyPerk;
use Perks\Company\Company\Domain\CompanyRepository;
use function Lambdish\Phunctional\map;

final class AllCompaniesSearcher
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchAll(): CompaniesResponse
    {
        return new CompaniesResponse(...map($this->toResponse(), $this->repository->searchAll()));
    }

    private function toResponse(): callable
    {
        return static fn(Company $company) => new CompanyResponse(
            $company->id()->value(),
            $company->name()->value(),
            $company->logo()->value(),
            $company->numberEmployees()->value(),
            map(
                static function (CompanyPerk $perk): array {
                    return [
                        'id'   => $perk->id()->value(),
                        'name' => $perk->name()->value()
                    ];
                },
                $company->perks()
            ),
        );
    }
}
