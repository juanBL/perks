<?php

declare(strict_types=1);

namespace Perks\Company\Company\Domain;

use Perks\Shared\Domain\Collection;

final class Companies extends Collection
{
    protected function type(): string
    {
        return Company::class;
    }
}
