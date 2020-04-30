<?php

declare(strict_types = 1);

namespace Perks\Tests\Backoffice\Courses\Domain;

use Perks\Shared\Domain\Criteria\Criteria;
use Perks\Tests\Shared\Domain\Criteria\CriteriaMother;
use Perks\Tests\Shared\Domain\Criteria\FilterMother;
use Perks\Tests\Shared\Domain\Criteria\FiltersMother;

final class BackofficeCourseCriteriaMother
{
    public static function nameContains(string $text): Criteria
    {
        return CriteriaMother::create(
            FiltersMother::createOne(
                FilterMother::fromValues(
                    [
                        'field'    => 'name',
                        'operator' => 'CONTAINS',
                        'value'    => $text,
                    ]
                )
            )
        );
    }
}
