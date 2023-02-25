<?php

namespace App\Form;

use App\Entity\Carrier;
use App\Entity\Mestables;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresses', EntityType::class, [
                'label' => 'Choissez votre table',
                'required' => true,
                'class' => Mestables::class,
                'multiple' => false,
                'expanded' => true,
                'attr' => ['class' => 'form-commande']

            ])->add('carriers', EntityType::class, [
                'label' => 'Choissez transporteur',
                'required' => true,
                'class' => Carrier::class,
                'multiple' => false,
                'expanded' => true,
                'attr' => ['class' => 'form-commande']

            ])->add('submit', SubmitType::class, [
                'label' => 'Confirmer ma commande', 'attr' => ['class' => 'btn btn-block btn-md btn-light']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
