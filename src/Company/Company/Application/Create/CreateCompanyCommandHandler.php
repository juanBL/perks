<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Create;

use Perks\Company\Company\Domain\CompanyLogo;
use Perks\Company\Company\Domain\CompanyName;
use Perks\Company\Company\Domain\CompanyNumberEmployees;
use Perks\Company\Company\Domain\CompanyPerk;
use Perks\Company\Company\Domain\CompanyPerks;
use Perks\Company\Perk\Domain\PerkName;
use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Company\Shared\Domain\Perks\PerkId;
use Perks\Shared\Domain\Bus\Command\CommandHandler;
use function Lambdish\Phunctional\map;

final class CreateCompanyCommandHandler implements CommandHandler
{
    private CompanyCreator $creator;

    public function __construct(CompanyCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCompanyCommand $command): void
    {
        $id              = new CompanyId($command->id());
        $name            = new CompanyName($command->name());
        $logo            = new CompanyLogo($command->logo());
        $numberEmployees = new CompanyNumberEmployees($command->numberEmployees());
        $perks           = new CompanyPerks(
            map(
                static function (array $companyPerk): CompanyPerk {
                    return CompanyPerk::create(new PerkId($companyPerk['id']), new PerkName($companyPerk['name']));
                },
                $command->perks()
            )
        );

        $this->creator->__invoke($id, $name, $logo, $numberEmployees, $perks);
    }
}
