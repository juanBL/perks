<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application\Create;

use Perks\Company\Company\Domain\Company;
use Perks\Company\Perk\Domain\Perk;
use Perks\Company\Perk\Domain\PerkName;
use Perks\Company\Perk\Domain\PerkRepository;
use Perks\Company\Shared\Domain\Perks\PerkId;

final class PerkCreator
{
    private PerkRepository $repository;

    public function __construct(PerkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PerkId $id, PerkName $name): void
    {
        $perk = Perk::create($id, $name);

        $this->repository->save($perk);
    }
}
