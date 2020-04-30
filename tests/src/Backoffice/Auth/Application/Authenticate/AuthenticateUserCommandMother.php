<?php

declare(strict_types = 1);

namespace Perks\Tests\Backoffice\Auth\Application\Authenticate;

use Perks\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use Perks\Backoffice\Auth\Domain\AuthPassword;
use Perks\Backoffice\Auth\Domain\AuthUsername;
use Perks\Tests\Backoffice\Auth\Domain\AuthPasswordMother;
use Perks\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandMother
{
    public static function create(AuthUsername $username, AuthPassword $password): AuthenticateUserCommand
    {
        return new AuthenticateUserCommand($username->value(), $password->value());
    }

    public static function random(): AuthenticateUserCommand
    {
        return self::create(AuthUsernameMother::random(), AuthPasswordMother::random());
    }
}
