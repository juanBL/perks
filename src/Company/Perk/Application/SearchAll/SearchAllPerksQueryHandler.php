<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application\SearchAll;

use Perks\Company\Perk\Application\PerksResponse;
use Perks\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllPerksQueryHandler implements QueryHandler
{
    private AllPerksSearcher $searcher;

    public function __construct(AllPerksSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchAllPerksQuery $query): PerksResponse
    {
        return $this->searcher->searchAll();
    }
}
