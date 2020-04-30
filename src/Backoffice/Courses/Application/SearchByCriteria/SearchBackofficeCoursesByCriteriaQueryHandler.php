<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Courses\Application\SearchByCriteria;

use Perks\Backoffice\Courses\Application\BackofficeCoursesResponse;
use Perks\Shared\Domain\Bus\Query\QueryHandler;
use Perks\Shared\Domain\Criteria\Filters;
use Perks\Shared\Domain\Criteria\Order;

final class SearchBackofficeCoursesByCriteriaQueryHandler implements QueryHandler
{
    private BackofficeCoursesByCriteriaSearcher $searcher;

    public function __construct(BackofficeCoursesByCriteriaSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchBackofficeCoursesByCriteriaQuery $query): BackofficeCoursesResponse
    {
        $filters = Filters::fromValues($query->filters());
        $order   = Order::fromValues($query->orderBy(), $query->order());

        return $this->searcher->search($filters, $order, $query->limit(), $query->offset());
    }
}
