<?php

declare(strict_types = 1);

namespace Perks\Tests\Shared\Domain\Criteria;

use Perks\Shared\Domain\Criteria\FilterField;
use Perks\Tests\Shared\Domain\WordMother;

final class FilterFieldMother
{
    public static function create($fieldName): FilterField
    {
        return new FilterField($fieldName);
    }

    public static function random(): FilterField
    {
        return self::create(WordMother::random());
    }
}
