<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Courses\Application\SearchByCriteria;

use Perks\Backoffice\Courses\Application\BackofficeCourseResponse;
use Perks\Backoffice\Courses\Application\BackofficeCoursesResponse;
use Perks\Backoffice\Courses\Domain\BackofficeCourse;
use Perks\Backoffice\Courses\Domain\BackofficeCourseRepository;
use Perks\Shared\Domain\Criteria\Criteria;
use Perks\Shared\Domain\Criteria\Filters;
use Perks\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class BackofficeCoursesByCriteriaSearcher
{
    private BackofficeCourseRepository $repository;

    public function __construct(BackofficeCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(Filters $filters, Order $order, ?int $limit, ?int $offset): BackofficeCoursesResponse
    {
        $criteria = new Criteria($filters, $order, $offset, $limit);

        return new BackofficeCoursesResponse(...map($this->toResponse(), $this->repository->matching($criteria)));
    }

    private function toResponse(): callable
    {
        return static fn(BackofficeCourse $course) => new BackofficeCourseResponse(
            $course->id(),
            $course->name(),
            $course->duration()
        );
    }
}
