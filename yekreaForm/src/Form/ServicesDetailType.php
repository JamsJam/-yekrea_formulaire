<?php

namespace App\Form;


use App\Entity\Services;
use App\Entity\ServicesDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ServicesDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'required'=> false
            ])
            ->add('prix',MoneyType::class,[
                'required' => false,
                'empty_data' => '0'
            ])

            ->add('prixMin',MoneyType::class,[
                'required' => false,
                
            ])
            
            ->add('services',EntityType::class,[
                'class' => Services::class,
                'required' => false,
                'choice_label' => 'nom',
                'placeholder' => 'select your service'
            ])
            // ->add('materiel')
            // ->add('commands')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ServicesDetail::class,
        ]);
    }
}
