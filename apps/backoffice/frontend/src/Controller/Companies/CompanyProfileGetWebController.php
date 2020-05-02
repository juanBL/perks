<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Company\Company\Application\CompanyResponse;
use Perks\Company\Company\Application\FindById\FindByIdCompanyQuery;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CompanyProfileGetWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $companyId, Request $request): Response
    {
        /** @var CompanyResponse $companyResponse */
        $companyResponse = $this->ask(new FindByIdCompanyQuery(new Uuid($companyId)));

        return $this->render(
            'pages/companies/company.html.twig',
            [
                'company' => $this->toArray($companyResponse),
            ]
        );
    }

    private function toArray(CompanyResponse $companyResponse): array
    {
        return [
            'id'              => $companyResponse->id(),
            'name'            => $companyResponse->name(),
            'logo'            => $companyResponse->logo(),
            'numberEmployees' => $companyResponse->numberEmployees(),
            'perks'           => $companyResponse->perks(),
        ];
    }
}
