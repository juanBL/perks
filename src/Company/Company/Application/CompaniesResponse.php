<?php

declare(strict_types=1);

namespace Perks\Company\Company\Application;

use Perks\Shared\Domain\Bus\Query\Response;

final class CompaniesResponse implements Response
{
    private array $companies;

    public function __construct(CompanyResponse ...$companies)
    {
        $this->companies = $companies;
    }

    public function companies(): array
    {
        return $this->companies;
    }
}
