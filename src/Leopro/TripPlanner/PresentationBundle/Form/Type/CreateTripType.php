<?php

namespace Leopro\TripPlanner\PresentationBundle\Form\Type;

use Leopro\TripPlanner\Application\Command\CreateTripCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateTripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('save', 'submit');
    }

    public function getName()
    {
        return 'trip';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Leopro\TripPlanner\Application\Command\CreateTripCommand',
            'empty_data' => function (FormInterface $form) {
                $command = new CreateTripCommand(
                    $form->get('name')->getData()
                );

                return $command;
            },
        ));
    }
} 