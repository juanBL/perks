<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Perks;

use Perks\Apps\Backoffice\Frontend\Controller\Perks\Form\Type\PerkType;
use Perks\Company\Perk\Application\Create\CreatePerkCommand;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

final class PerksPostWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $form = $this->form()->create(PerkType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->createPerk($form->getData());
        }

        return $this->redirectWithCustomError('perks_get', 'Error al crear el beneficio', $request);
    }

    private function createPerk(array $data): RedirectResponse
    {
        $this->dispatch(new CreatePerkCommand(Uuid::random()->value(), $data['name']));

        return $this->redirectWithMessage(
            'perks_get',
            sprintf('El beneficio %s ha sido creado!', $data['name'])
        );
    }
}
