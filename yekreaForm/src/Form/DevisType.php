<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numDevis',TextType::class,[
                'disabled' => true
            ])
            ->add('command',EntityType::class,[
                'class' => CommandType::class,
                'choice_label' => 'nbCommande',
                'disabled' => true
            ])
            ->add('prix_final',MoneyType::class,[
                'currency' => 'euro',
                'required' => 'false',
                
            ])
            ->add('service',TextType::class,[
                'required' => false,

            ])
            ->add('serviceDetail',TextType::class,[
                'required' => false,
                

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
