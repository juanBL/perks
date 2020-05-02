<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\FindById;

use Perks\Company\Company\Application\CompanyResponse;
use Perks\Company\Company\Domain\CompanyPerk;
use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\map;

final class FindByIdCompanyQueryHandler implements QueryHandler
{
    private CompanyByIdFinder $finder;

    public function __construct(CompanyByIdFinder $searcher)
    {
        $this->finder = $searcher;
    }

    public function __invoke(FindByIdCompanyQuery $query): CompanyResponse
    {
        $companyId = new CompanyId($query->id()->value());

        $company = $this->finder->__invoke($companyId);

        return new CompanyResponse(
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
            )
        );
    }
}
