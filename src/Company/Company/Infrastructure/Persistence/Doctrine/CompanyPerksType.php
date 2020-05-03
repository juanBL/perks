<?php

declare(strict_types=1);

namespace Perks\Company\Company\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use Perks\Company\Company\Domain\CompanyPerk;
use Perks\Company\Company\Domain\CompanyPerks;
use Perks\Company\Perk\Domain\PerkName;
use Perks\Company\Shared\Domain\Perks\PerkId;
use Perks\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use function Lambdish\Phunctional\map;

final class CompanyPerksType extends JsonType implements DoctrineCustomType
{
    public static function customTypeName(): string
    {
        return 'perks';
    }

    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return parent::convertToDatabaseValue(map($this->values(), $value), $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CompanyPerks
    {
        $scalars = parent::convertToPHPValue($value, $platform);

        return new CompanyPerks(map($this->toCompanyPerks(), $scalars ?? []));
    }

    private function values(): callable
    {
        return static function (CompanyPerk $companyPerk): array {
            return [
                'id'   => $companyPerk->id()->value(),
                'name' => $companyPerk->name()->value(),
            ];
        };
    }

    private function toCompanyPerks(): callable
    {
        return static function (array $perk) {
            return CompanyPerk::create(new PerkId($perk['id']), new PerkName($perk['name']));
        };
    }
}
