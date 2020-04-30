<?php

declare(strict_types = 1);

namespace Perks\Company\Company\Domain;

use Perks\Company\Shared\Domain\Companies\CompanyId;
use Perks\Shared\Domain\DomainError;

final class CompanyNotExist extends DomainError
{
    private CompanyId $id;

    public function __construct(CompanyId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'company_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The company <%s> does not exist', $this->id->value());
    }
}
