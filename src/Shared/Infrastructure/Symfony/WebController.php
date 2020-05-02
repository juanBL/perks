<?php

declare(strict_types=1);

namespace Perks\Shared\Infrastructure\Symfony;

use Perks\Shared\Domain\Bus\Command\CommandBus;
use Perks\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Twig\Environment;

abstract class WebController extends ApiController
{
    private Environment          $twig;
    private RouterInterface      $router;
    private SessionInterface     $session;
    private FormFactoryInterface $form;

    public function __construct(
        Environment $twig,
        RouterInterface $router,
        SessionInterface $session,
        QueryBus $queryBus,
        CommandBus $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler,
        FormFactoryInterface $form
    ) {
        parent::__construct($queryBus, $commandBus, $exceptionHandler);
        $this->twig    = $twig;
        $this->router  = $router;
        $this->session = $session;
        $this->form    = $form;
    }

    public function render(string $templatePath, array $arguments = []): SymfonyResponse
    {
        return new SymfonyResponse($this->twig->render($templatePath, $arguments));
    }

    public function redirect(string $routeName, ?array $params = []): RedirectResponse
    {
        return new RedirectResponse($this->router->generate($routeName, $params), 302);
    }

    public function redirectWithMessage(string $routeName, string $message, ?array $params = []): RedirectResponse
    {
        $this->addFlashFor('message', [$message]);

        return $this->redirect($routeName, $params);
    }

    public function redirectWithErrors(
        string $routeName,
        ConstraintViolationListInterface $errors,
        Request $request
    ): RedirectResponse {
        $this->addFlashFor('errors', $this->formatFlashErrors($errors));
        $this->addFlashFor('inputs', $request->request->all());

        return new RedirectResponse($this->router->generate($routeName), 302);
    }

    public function redirectWithCustomError(
        string $routeName,
        string $error,
        Request $request
    ): RedirectResponse {
        $this->addFlashFor('errors', $this->formatFlashErrors($error));
        $this->addFlashFor('inputs', $request->request->all());

        return new RedirectResponse($this->router->generate($routeName), 302);
    }

    private function formatFlashErrors(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        foreach ($violations as $violation) {
            $errors[str_replace(['[', ']'], ['', ''], $violation->getPropertyPath())] = $violation->getMessage();
        }

        return $errors;
    }

    private function addFlashFor(string $prefix, array $messages): void
    {
        foreach ($messages as $key => $message) {
            $this->session->getFlashBag()->set($prefix . '.' . $key, $message);
        }
    }

    public function form(): FormFactoryInterface
    {
        return $this->form;
    }
}
