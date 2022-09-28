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
        // Si on arrive sur le forme sans passer par le form client, 
        //alors la variable GET 'client 'n'existe pas, 
        //donc on affiche le form de 'client' 
        if(!isset($_GET['client'])){
            $builder
            ->add('client',EntityType::class, [
                'class' => Client::class,
                'choice_label'=> 'societe',
                'label' => false
            ]);
        }
        $builder


            ->add('servicesDetail',EntityType::class,[
                'class' => ServicesDetail::class,
                'choice_label' => 'nom',
                'required' => false,
                'multiple' => true,
                'expanded' => true
                
            ])
                ;
            }
                
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }
}
