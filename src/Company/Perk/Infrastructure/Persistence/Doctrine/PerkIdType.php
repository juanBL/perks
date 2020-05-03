<?php

declare(strict_types=1);

namespace Perks\Company\Perk\Infrastructure\Persistence\Doctrine;

use Perks\Company\Shared\Domain\Perks\PerkId;
use Perks\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class PerkIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'perk_id';
    }

    protected function typeClassName(): string
    {
        return PerkId::class;
    }
}
