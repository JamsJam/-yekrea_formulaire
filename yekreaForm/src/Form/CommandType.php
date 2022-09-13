<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Command;
use App\Entity\ServicesDetail;
use PhpParser\Parser\Multiple;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createDate') // in controller
            ->add('nbCommande') //nb unique + id commande

            ->add('user',EntityType::class,[
                'class' => User::class,
                'choice_label' => 'email',
                'required' => false
                // 'choice_value' => 
            ])
            ->add('client',EntityType::class,[
                'class' => Client::class,
                'choice_label' => 'societe',
                'required' => false

            ])
            ->add('servicesDetail',EntityType::class,[
                'class' => ServicesDetail::class,
                'choice_label' => 'nom',
                'required' => false,
                'multiple' => true
                
            ])
            // ->add('validationDate', DateTimeType::class, [ // a rentrer plus tard
            //     'widget' => 'single_text' ,
            //     'required' => false
                
                // this is actually the default format for single_text
                // 'format' => 'yyyy-MM-dd',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }
}
