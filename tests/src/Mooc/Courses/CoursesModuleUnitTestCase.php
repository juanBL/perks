<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Courses;

use Perks\Mooc\Courses\Domain\Course;
use Perks\Mooc\Courses\Domain\CourseRepository;
use Perks\Mooc\Shared\Domain\Course\CourseId;
use Perks\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesModuleUnitTestCase extends UnitTestCase
{
    private $repository;

    protected function shouldSave(Course $course): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($course))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(CourseId $id, ?Course $course): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($id))
            ->once()
            ->andReturn($course);
    }

    /** @return CourseRepository|MockInterface */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(CourseRepository::class);
    }
}
