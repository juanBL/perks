<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Apps\Backoffice\Frontend\Controller\Companies\Form\Type\CompanyType;
use Perks\Company\Company\Application\Create\CreateCompanyCommand;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

final class CompaniesPostWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $form = $this->form()->create(CompanyType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->createCompany($form->getData());
        }

        return $this->redirectWithCustomError('company_get', 'Error al crear la empresa', $request);
    }

    private function createCompany(array $data): RedirectResponse
    {
        $this->dispatch(
            new CreateCompanyCommand(
                Uuid::random()->value(),
                $data['name'],
                $data['logo']->getClientOriginalName(),
                (int) $data['numberEmployees'],
                [['id' => Uuid::random()->value(), 'name' => 'test']], //todo
            )
        );

        return $this->redirectWithMessage(
            'company_get',
            sprintf('La empresa %s ha sido creada!', $data['name'])
        );
    }
}
