<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Application\SearchAll;

use Perks\Company\Perk\Application\PerkResponse;
use Perks\Company\Perk\Application\PerksResponse;
use Perks\Company\Perk\Domain\Perk;
use Perks\Company\Perk\Domain\PerkRepository;
use function Lambdish\Phunctional\map;

final class AllPerksSearcher
{
    private PerkRepository $repository;

    public function __construct(PerkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchAll(): PerksResponse
    {
        return new PerksResponse(...map($this->toResponse(), $this->repository->searchAll()));
    }

    private function toResponse(): callable
    {
        return static fn(Perk $perk) => new PerkResponse(
            $perk->id()->value(), $perk->name()->value()
        );
    }
}
