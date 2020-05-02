<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Update\Deactivate;

use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Shared\Domain\Bus\Command\CommandHandler;

final class DeactivateCommandHandler implements CommandHandler
{
    private CompanyDeactivator $deactivator;

    public function __construct(CompanyDeactivator $creator)
    {
        $this->deactivator = $creator;
    }

    public function __invoke(DeactivateCompanyCommand $command): void
    {
        $id = new CompanyId($command->id()->value());

        $this->deactivator->__invoke($id);
    }
}
