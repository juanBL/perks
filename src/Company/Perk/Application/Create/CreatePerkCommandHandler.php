<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application\Create;

use Perks\Company\Perk\Domain\PerkName;
use Perks\Company\Shared\Domain\Perks\PerkId;
use Perks\Shared\Domain\Bus\Command\CommandHandler;

final class CreatePerkCommandHandler implements CommandHandler
{
    private PerkCreator $creator;

    public function __construct(PerkCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreatePerkCommand $command): void
    {
        $id   = new PerkId($command->id());
        $name = new PerkName($command->name());

        $this->creator->__invoke($id, $name);
    }
}
