<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\CoursesCounter;

use Perks\Mooc\CoursesCounter\Domain\CoursesCounter;
use Perks\Mooc\CoursesCounter\Domain\CoursesCounterRepository;
use Perks\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesCounterModuleUnitTestCase extends UnitTestCase
{
    private $repository;

    protected function shouldSave(CoursesCounter $course): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with($this->similarTo($course))
            ->andReturnNull();
    }

    protected function shouldSearch(?CoursesCounter $counter): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->once()
            ->andReturn($counter);
    }

    /** @return CoursesCounterRepository|MockInterface */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(CoursesCounterRepository::class);
    }
}
