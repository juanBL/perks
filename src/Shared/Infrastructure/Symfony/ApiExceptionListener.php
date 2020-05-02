<?php

declare(strict_types = 1);

namespace Perks\Shared\Infrastructure\Symfony;

use Perks\Shared\Domain\DomainError;
use Perks\Shared\Domain\Utils;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class ApiExceptionListener
{
    private ApiExceptionsHttpStatusCodeMapping $exceptionHandler;

    public function __construct(ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onException(RequestEvent $event): void
    {
        dump($event->getThrowable());die;
        $exception = $event->getException();

        $event->setResponse(
            new JsonResponse(
                [
                    'code'    => $this->exceptionCodeFor($exception),
                    'message' => $exception->getMessage(),
                ],
                $this->exceptionHandler->statusCodeFor(get_class($exception))
            )
        );
    }

    private function exceptionCodeFor(Exception $error): string
    {
        $domainErrorClass = DomainError::class;

        return $error instanceof $domainErrorClass ? $error->errorCode() : Utils::toSnakeCase(class_basename($error));
    }
}
