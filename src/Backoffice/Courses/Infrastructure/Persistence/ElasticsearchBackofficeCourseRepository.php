<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Courses\Infrastructure\Persistence;

use Perks\Backoffice\Courses\Domain\BackofficeCourse;
use Perks\Backoffice\Courses\Domain\BackofficeCourseRepository;
use Perks\Shared\Domain\Criteria\Criteria;
use Perks\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchRepository;
use function Lambdish\Phunctional\map;

final class ElasticsearchBackofficeCourseRepository extends ElasticsearchRepository implements BackofficeCourseRepository
{
    public function save(BackofficeCourse $course): void
    {
        $this->persist($course->id(), $course->toPrimitives());
    }

    public function searchAll(): array
    {
        return map($this->toCourse(), $this->searchAllInElastic());
    }

    public function matching(Criteria $criteria): array
    {
        return map($this->toCourse(), $this->searchByCriteria($criteria));
    }

    protected function aggregateName(): string
    {
        return 'courses';
    }

    private function toCourse(): callable
    {
        return static fn(array $primitives) => BackofficeCourse::fromPrimitives($primitives);
    }
}
