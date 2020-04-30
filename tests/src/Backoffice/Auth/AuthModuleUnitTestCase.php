<?php

declare(strict_types = 1);

namespace Perks\Tests\Backoffice\Auth;

use Perks\Backoffice\Auth\Domain\AuthRepository;
use Perks\Backoffice\Auth\Domain\AuthUser;
use Perks\Backoffice\Auth\Domain\AuthUsername;
use Perks\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class AuthModuleUnitTestCase extends UnitTestCase
{
    private $repository;

    protected function shouldSearch(AuthUsername $username, AuthUser $authUser = null): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($username))
            ->once()
            ->andReturn($authUser);
    }

    /** @return AuthRepository|MockInterface */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(AuthRepository::class);
    }
}
