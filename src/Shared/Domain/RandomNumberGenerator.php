<?php

declare(strict_types = 1);

namespace Perks\Shared\Domain;

interface RandomNumberGenerator
{
    public function generate(): int;
}
