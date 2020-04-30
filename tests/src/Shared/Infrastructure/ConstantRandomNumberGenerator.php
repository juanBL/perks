<?php

declare(strict_types = 1);

namespace Perks\Tests\Shared\Infrastructure;

use Perks\Shared\Domain\RandomNumberGenerator;

final class ConstantRandomNumberGenerator implements RandomNumberGenerator
{
    public function generate(): int
    {
        return 1;
    }
}
