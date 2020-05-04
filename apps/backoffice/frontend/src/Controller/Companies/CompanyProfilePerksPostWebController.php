<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Apps\Backoffice\Frontend\Controller\Companies\Form\Type\PerksType;
use Perks\Company\Company\Application\CompanyResponse;
use Perks\Company\Company\Application\FindById\FindByIdCompanyQuery;
use Perks\Company\Company\Application\Update\Perks\UpdateCompanyPerksCommand;
use Perks\Company\Perk\Application\PerkResponse;
use Perks\Company\Perk\Application\PerksResponse;
use Perks\Company\Perk\Application\SearchAll\SearchAllPerksQuery;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function Lambdish\Phunctional\map;

final class CompanyProfilePerksPostWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $companyId, Request $request): Response
    {
        /** @var CompanyResponse $companyResponse */
        $companyResponse = $this->ask(new FindByIdCompanyQuery(new Uuid($companyId)));

        $form = $this->form()->create(
            PerksType::class,
            ['selectedPerks' => $companyResponse->perks(), 'perks' => $this->perks()]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedPerks = $this->selectedPerks($form->getData());
            $this->dispatch(new UpdateCompanyPerksCommand($companyId, $selectedPerks));

            return $this->redirectWithMessage(
                'company_profile_get',
                sprintf('Los perks de la empresa han sido actualizados!'),
                ['companyId' => $companyId]
            );
        }

        return $this->render(
            'pages/companies/company.html.twig',
            [
                'company' => $this->toArray($companyResponse),
                'form'    => $form->createView()
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

    private function selectedPerks(array $data): array
    {
        $perks = $data['perks'];

        return map(
            static function (string $id) use ($perks) {
                $key = array_search($id, array_column($perks, 'id'), true);

                return $perks[$key];
            },
            $data['perksToSelect']
        );
    }
}
