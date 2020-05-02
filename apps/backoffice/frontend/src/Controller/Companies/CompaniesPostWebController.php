<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies;

use Perks\Company\Company\Application\Create\CreateCompanyCommand;
use Perks\Shared\Domain\ValueObject\Uuid;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class CompaniesPostWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $validationErrors = $this->validateRequest($request);

        return $validationErrors->count() ? $this->redirectWithErrors('company_get', $validationErrors, $request)
            : $this->createCompany($request);
    }

    private function validateRequest(Request $request): ConstraintViolationListInterface
    {
        $constraint = new Assert\Collection(
            [
                'name'            => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
                'logo'            => [new Assert\NotBlank()],
                'numberEmployees' => [new Assert\NotBlank()],
                'perks'           => [new Assert\NotBlank()],
                'submit'          => [new Assert\Blank()],
            ]
        );

        $input = $request->request->all()['company'];

        return Validation::createValidator()->validate($input, $constraint);
    }

    private function createCompany(Request $request): RedirectResponse
    {
        $this->dispatch(
            new CreateCompanyCommand(
                Uuid::random()->value(),
                $request->request->get('company')['name'],
                $request->request->get('company')['logo'],
                (int) $request->request->get('company')['numberEmployees'],
                [['id' => Uuid::random()->value(), 'name' => 'test']], //todo
            )
        );

        return $this->redirectWithMessage(
            'company_get',
            sprintf('La empresa %s ha sido creada!', $request->request->get('name'))
        );
    }
}
