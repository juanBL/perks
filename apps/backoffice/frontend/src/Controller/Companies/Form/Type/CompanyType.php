<?php

declare(strict_types=1);

namespace Perks\Apps\Backoffice\Frontend\Controller\Companies\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

final class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class)->add(
            'logo',
            FileType::class,
            [
                'constraints' => [
                    new File(
                        [
                            'maxSize'          => '1024k',
                            'mimeTypes'        => [
                                'image/png',
                            ],
                            'mimeTypesMessage' => 'Please upload a valid PNG image',
                        ]
                    )
                ]
            ]
        )->add('numberEmployees', NumberType::class)->add(
            'perks',
            ChoiceType::class,
            [
                'choices' => [
                    'Maybe' => null,
                    'Yes'   => true,
                    'No'    => false,
                ],
                'multiple' => true
            ]
        )->add('submit', SubmitType::class);
    }
}
