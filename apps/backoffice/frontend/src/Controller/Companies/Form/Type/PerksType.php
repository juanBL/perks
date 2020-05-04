<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

final class PerksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $formattedPerks = $this->formattedPerks($options['data']['perks']);
        $builder->add(
            'perksToSelect',
            ChoiceType::class,
            [
                'choices'  => array_flip($formattedPerks),
                'mapped'   => true,
                'multiple' => true,
                'data'     => array_column($options['data']['selectedPerks'], 'id')
            ]
        )->add('submit', SubmitType::class);
    }

    private function formattedPerks(array $perks): array
    {
        $formattedPerks = [];
        foreach ($perks as $perk) {
            $formattedPerks[$perk['id']] = $perk['name'];
        }

        return $formattedPerks;
    }
}
