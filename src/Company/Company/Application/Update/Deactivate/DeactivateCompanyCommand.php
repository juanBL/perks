<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application\Update\Deactivate;

use Perks\Shared\Domain\Bus\Command\Command;
use Perks\Shared\Domain\ValueObject\Uuid;

final class DeactivateCompanyCommand implements Command
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
