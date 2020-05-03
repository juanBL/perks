<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Apps\Backoffice\Frontend\Controller\Companies\Form\Type\CompanyType;
use Perks\Company\Company\Application\CompaniesResponse;
use Perks\Company\Company\Application\CompanyResponse;
use Perks\Company\Company\Application\SearchAll\SearchAllCompaniesQuery;
use Perks\Company\Perk\Application\PerkResponse;
use Perks\Company\Perk\Application\PerksResponse;
use Perks\Company\Perk\Application\SearchAll\SearchAllPerksQuery;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function Lambdish\Phunctional\map;

final class CompaniesGetWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): Response
    {
        /** @var CompaniesResponse $companiesResponse */
        $companiesResponse = $this->ask(new SearchAllCompaniesQuery());

        $form = $this->form()->create(CompanyType::class, ['perks' => $this->perks()]);

        return $this->render(
            'pages/companies/companies.html.twig',
            [
                'new_company_id' => Uuid::random()->value(),
                'companies'      => map($this->toArray(), $companiesResponse->companies()),
                'form'           => $form->createView()
            ]
        );
    }

    private function toArray(): callable
    {
        return static function (CompanyResponse $companyResponse) {
            return [
                'id'              => $companyResponse->id(),
                'name'            => $companyResponse->name(),
                'logo'            => $companyResponse->logo(),
                'numberEmployees' => $companyResponse->numberEmployees(),
                'perks'           => $companyResponse->perks(),
            ];
        };
    }

    private function perks(): array
    {
        /** @var PerksResponse $perksResponse */
        $perksResponse = $this->ask(new SearchAllPerksQuery());

        return map(
            static function (PerkResponse $perkResponse) {
                return [
                    'id'   => $perkResponse->id(),
                    'name' => $perkResponse->name(),
                ];
            },
            $perksResponse->perks()
        );
    }
}
