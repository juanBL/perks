<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Perks;

use Perks\Company\Perk\Application\PerkResponse;
use Perks\Company\Perk\Application\PerksResponse;
use Perks\Company\Perk\Application\SearchAll\SearchAllPerksQuery;
use Perks\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function Lambdish\Phunctional\map;

final class PerksGetWebController extends WebController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): Response
    {
        /** @var PerksResponse $perksResponse */
        $perksResponse = $this->ask(new SearchAllPerksQuery());

        return $this->render(
            'pages/perks/perks.html.twig',
            [
                'perks' => map($this->toArray(), $perksResponse->perks()),
            ]
        );
    }

    private function toArray(): callable
    {
        return static function (PerkResponse $perkResponse) {
            return [
                'id'   => $perkResponse->id(),
                'name' => $perkResponse->name(),
            ];
        };
    }
}
