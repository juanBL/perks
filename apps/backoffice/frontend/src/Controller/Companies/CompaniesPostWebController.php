<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Apps\Backoffice\Frontend\Controller\Companies\Form\Type\CompanyType;
use Perks\Company\Company\Application\Create\CreateCompanyCommand;
use Perks\Company\Perk\Application\PerkResponse;
use Perks\Company\Perk\Application\PerksResponse;
use Perks\Company\Perk\Application\SearchAll\SearchAllPerksQuery;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

final class CompaniesPostWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $form = $this->form()->create(CompanyType::class, ['perks' => $this->perks()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->createCompany($form->getData());
        }

        return $this->redirectWithCustomError('company_get', 'Error al crear la empresa', $request);
    }

    private function createCompany(array $data): RedirectResponse
    {
        $selectedPerks = $this->selectedPerks($data);

        $this->dispatch(
            new CreateCompanyCommand(
                Uuid::random()->value(),
                $data['name'],
                $data['logo']->getClientOriginalName(),
                (int) $data['numberEmployees'],
                $selectedPerks
            )
        );

        return $this->redirectWithMessage(
            'company_get',
            sprintf('La empresa %s ha sido creada!', $data['name'])
        );
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
