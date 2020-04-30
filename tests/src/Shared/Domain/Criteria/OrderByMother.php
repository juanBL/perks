<?php

declare(strict_types = 1);

namespace Perks\Tests\Shared\Domain\Criteria;

use Perks\Shared\Domain\Criteria\OrderBy;
use Perks\Tests\Shared\Domain\WordMother;

final class OrderByMother
{
    public static function create($fieldName): OrderBy
    {
        return new OrderBy($fieldName);
    }

    public static function random(): OrderBy
    {
        return self::create(WordMother::random());
    }
}
