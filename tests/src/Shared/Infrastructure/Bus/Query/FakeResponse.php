<?php

declare(strict_types = 1);

namespace Perks\Tests\Shared\Infrastructure\Bus\Query;

use Perks\Shared\Domain\Bus\Query\Response;

final class FakeResponse implements Response
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function number(): int
    {
        return $this->number;
    }
}
