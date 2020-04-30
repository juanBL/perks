<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Courses;

use Perks\Mooc\Courses\Domain\CourseRepository;
use Perks\Tests\Mooc\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;

abstract class CoursesModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
    protected function repository(): CourseRepository
    {
        return $this->service(CourseRepository::class);
    }
}
