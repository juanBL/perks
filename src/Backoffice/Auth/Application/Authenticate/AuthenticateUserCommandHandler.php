<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Auth\Application\Authenticate;

use Perks\Backoffice\Auth\Domain\AuthPassword;
use Perks\Backoffice\Auth\Domain\AuthUsername;
use Perks\Shared\Domain\Bus\Command\CommandHandler;

final class AuthenticateUserCommandHandler implements CommandHandler
{
    private UserAuthenticator $authenticator;

    public function __construct(UserAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(AuthenticateUserCommand $command): void
    {
        $username = new AuthUsername($command->username());
        $password = new AuthPassword($command->password());

        $this->authenticator->authenticate($username, $password);
    }
}
