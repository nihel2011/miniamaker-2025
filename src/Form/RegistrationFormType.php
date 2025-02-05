<?php

namespace App\Form;

use App\Entity\User;
use PharIo\Manifest\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse email',
                'label_attr' => [

                    'class' => 'form-label'
                ],
                'attr' => [
                    'placeholder' => 'martin@gmail.com',
                    'class' => 'form-control',
                    // 'required' => true
                ],

            ])
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'label' => 'Mot de passe',
                    'label_attr' => ['class' => 'form-label'],
                    'type' => PasswordType::class, // avec quoi tu est associé à la répétition

                    'invalid_message' => 'Les mots de passe doivent correspondre.',
                    'mapped' => false,
                    'attr' => ['autocomplete' => 'new-password'],
                    'first_options' => [
                        'label' => 'Mot de passe',
                        'label_attr' => ['class' => 'form-label mb-3'],
                        'attr' => [
                            'class' => 'form-control'
                        ]

                    ],
                    'second_options' => [
                        'label' => 'Confirmer le mot de passe',
                        'label_attr' => ['class' => 'form-label mb-3'],
                        'attr' => [
                            'class' => 'form-control '
                        ]
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Merci de saisir un mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ]
            )

            ->add('isMinor', CheckboxType::class, [
                'row_attr' => [
                    'class' => 'form-check mb-2'
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => 'Vous confirmez que vous être majour',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez être majour pour vous inscrire.',
                    ]),
                ],
            ])
            ->add('isTerms', CheckboxType::class, [
                'row_attr' => [
                    'class' => 'form-check mb-2'
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => 'J\' accepte les CGU',

                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les GCU pour vous inscrire.',
                    ]),
                ],
            ])
            ->add('isGpdr', CheckboxType::class, [
                'row_attr' => [
                    'class' => 'form-check mb-2'
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => 'J\'accepte  la politique de RGPD',

                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous deveznotre politique de RGPD pour vous inscrire.',
                    ]),
                ],
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
