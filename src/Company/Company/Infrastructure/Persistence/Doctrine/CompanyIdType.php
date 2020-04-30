<?php

declare(strict_types=1);

namespace Perks\Company\Company\Infrastructure\Persistence\Doctrine;

use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CompanyIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'company_id';
    }

    protected function typeClassName(): string
    {
        return CompanyId::class;
    }
}
