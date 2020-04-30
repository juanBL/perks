<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Auth\Infrastructure\Persistence;

use Perks\Backoffice\Auth\Domain\AuthPassword;
use Perks\Backoffice\Auth\Domain\AuthRepository;
use Perks\Backoffice\Auth\Domain\AuthUser;
use Perks\Backoffice\Auth\Domain\AuthUsername;
use function Lambdish\Phunctional\get;

final class InMemoryAuthRepository implements AuthRepository
{
    private const USERS = [
        'javi' => 'barbitas',
        'rafa' => 'pelazo',
    ];

    public function search(AuthUsername $username): ?AuthUser
    {
        $password = get($username->value(), self::USERS);

        return null !== $password ? new AuthUser($username, new AuthPassword($password)) : null;
    }
}
