<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\SearchAll;

use Perks\Company\Company\Application\CompaniesResponse;
use Perks\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllCompaniesQueryHandler implements QueryHandler
{
    private AllCompaniesSearcher $searcher;

    public function __construct(AllCompaniesSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchAllCompaniesQuery $query): CompaniesResponse
    {
        return $this->searcher->searchAll();
    }
}
