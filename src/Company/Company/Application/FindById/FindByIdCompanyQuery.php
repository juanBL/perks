<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\FindById;

use Perks\Shared\Domain\Bus\Query\Query;
use Perks\Shared\Domain\ValueObject\Uuid;

final class FindByIdCompanyQuery implements Query
{
    private Uuid $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id(): Uuid
    {
        return $this->id;
    }
}
