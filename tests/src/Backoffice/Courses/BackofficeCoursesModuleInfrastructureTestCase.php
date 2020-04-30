<?php

declare(strict_types = 1);

namespace Perks\Tests\Backoffice\Courses;

use Perks\Backoffice\Courses\Infrastructure\Persistence\MySqlBackofficeCourseRepository;
use Perks\Tests\Mooc\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class BackofficeCoursesModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
    protected function repository(): MySqlBackofficeCourseRepository
    {
        return new MySqlBackofficeCourseRepository($this->service(EntityManager::class));
    }
}
