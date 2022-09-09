<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'required' => false,
                "attr"=>[
                    "class"=> "bg-light"
                ],
            ])
            ->add('nom',TextType::class,[
                'required' => false,
                "attr"=>[
                    "class"=> "bg-light"
                ],
                ])
                ->add('prenom',TextType::class,[
                    'required' => false,
                    "attr"=>[
                        "class"=> "bg-light"
                    ],
                ])

                -> add('roles',ChoiceType::class, [
                    "attr"=>[
                        "class"=> "bg-light"
                    ],
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'empty_data' => 'ROLE_USER',
                    'choices'  => [
                        'Client'        => '',
                        'Commercial'    => 'ROLE_COMMERCIAL',
                        'Admin'         => 'ROLE_ADMIN',
                    ],
                    ])
                    
                    ->add('password', PasswordType::class,[
                        "attr"=>[
                            "class"=> "bg-light"
                        ],
                        'required' => false,
                        'empty_data' => ''
                    ]);
                
                    
        
                    //l'utilisateur à les droits admin
                        // ->add('client')
                        
                        
                        // // Data transformer
                        // $builder->get('roles')
                        //     ->addModelTransformer(new CallbackTransformer(
        
        //         function ($rolesArray) {
        //              // transform the array to a string
        //              return count($rolesArray)? $rolesArray[0]: null;
        //         },
        //         function ($rolesString) {
        //              // transform the string back to an array
        //              return [$rolesString];
        //         }
        // ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
