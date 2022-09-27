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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType
{
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
    $this->token = $token;
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {



        
        
        $user = $this->token->getToken()->getUser();
        // dd($user);
        $builder
        ->add('email',EmailType::class,[
                'required' => false,
                "label"=> 'Email',
                "attr"=>[
                    "class"=> "bg-light"
                ],
                ])
            ->add('nom',TextType::class,[
                'required' => false,
                "label"=> 'Nom',
                "attr"=>[
                    "class"=> "bg-light"
                ],
                ])
                
            ->add('prenom',TextType::class,[
                'required' => false,
                "label"=> 'Prénom',
                "attr"=>[
                    "class"=> "bg-light"
                ],
                ]);
                
                
            if ($user->getRoleInt() == 1) { //renvoie une erreur mais fonctionne pour recuperer l'iD du role du User
                $builder
                -> add('roles',ChoiceType::class, [
                    "label"=> 'Role',
                    'required' => false,
                    "attr"=>[
                        "class"=> "bg-light"
                    ],
                    'choices'  => [
                        'Client'        => 'ROLE_USER',
                        'Commercial'    => 'ROLE_COMMERCIAL',
                        'Admin'         => 'ROLE_ADMIN',
                    ]
                ]);
                    // Convertis les donnee du formulaire en string puis les reconvertis en array
                        $builder->get('roles')
                        ->addModelTransformer(new CallbackTransformer(
                            function ($rolesArray) {
                                    // transform the array to a string
                                return count($rolesArray)? $rolesArray[0]: null;
                            },
                            function ($rolesString) {
                                    // transform the string back to an array
                                return [$rolesString];
                            }
                    ));
                        
                }
                        
                        
                        
                    }
                    
                    
                    public function configureOptions(OptionsResolver $resolver): void
                    {
                        $resolver->setDefaults([
                            'data_class' => User::class,
                        ]);
                    }
                }
                
                



