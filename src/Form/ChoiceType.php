<?php

namespace App\Form;

use App\Entity\Equip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Form\ChoiceList\ChoiceList;

class relou extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('equip', ChoiceList::class, [
                'label' => 'Choisir une équipe',
                'class' => Equip::class,
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'data_class' => Equip::class,

        ]);
    }
}
