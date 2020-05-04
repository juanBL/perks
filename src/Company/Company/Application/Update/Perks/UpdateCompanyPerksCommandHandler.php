<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Update\Perks;

use Perks\Company\Company\Domain\CompanyPerk;
use Perks\Company\Company\Domain\CompanyPerks;
use Perks\Company\Perk\Domain\PerkName;
use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Company\Shared\Domain\Perks\PerkId;
use Perks\Shared\Domain\Bus\Command\CommandHandler;
use function Lambdish\Phunctional\map;

final class UpdateCompanyPerksCommandHandler implements CommandHandler
{
    private CompanyPerksUpdatter $updatter;

    public function __construct(CompanyPerksUpdatter $updatter)
    {
        $this->updatter = $updatter;
    }

    public function __invoke(UpdateCompanyPerksCommand $command): void
    {
        $id    = new CompanyId($command->id());
        $perks = new CompanyPerks(
            map(
                static function (array $perk): CompanyPerk {
                    return CompanyPerk::create(new PerkId($perk['id']), new PerkName($perk['name']));
                },
                $command->perks()
            )
        );

        $this->updatter->__invoke($id, $perks);
    }
}
