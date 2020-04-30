<?php

declare(strict_types = 1);

namespace Perks\Tests\Backoffice\Auth\Domain;

use Perks\Backoffice\Auth\Domain\AuthPassword;
use Perks\Tests\Shared\Domain\UuidMother;

final class AuthPasswordMother
{
    public static function create(string $value): AuthPassword
    {
        return new AuthPassword($value);
    }

    public static function random(): AuthPassword
    {
        return self::create(UuidMother::random());
    }
}
