<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Company\Company\Application\Update\Deactivate\DeactivateCompanyCommand;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CompanyDeactivatePutWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $companyId, Request $request): Response
    {
        $this->dispatch(new DeactivateCompanyCommand(new Uuid($companyId)));

        return $this->redirectWithMessage(
            'company_profile_get',
            sprintf('La empresa con id %s ha sido desactiva!', $companyId),
            ['companyId' => $companyId]
        );
    }
}
