<?php

declare(strict_types = 1);

namespace Perks\Tests\Shared\Domain\Criteria;

use Perks\Shared\Domain\Criteria\FilterValue;
use Perks\Tests\Shared\Domain\WordMother;

final class FilterValueMother
{
    public static function create($value): FilterValue
    {
        return new FilterValue($value);
    }

    public static function random(): FilterValue
    {
        return self::create(WordMother::random());
    }
}
