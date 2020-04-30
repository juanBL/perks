<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Courses\Application\Create;

use Perks\Backoffice\Courses\Domain\BackofficeCourse;
use Perks\Backoffice\Courses\Domain\BackofficeCourseRepository;

final class BackofficeCourseCreator
{
    private BackofficeCourseRepository $repository;

    public function __construct(BackofficeCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $id, string $name, string $duration): void
    {
        $this->repository->save(new BackofficeCourse($id, $name, $duration));
    }
}
