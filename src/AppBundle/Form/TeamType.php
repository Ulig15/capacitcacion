<?php

namespace AppBundle\Form;

use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label'     => 'nombre',
            'required'  => true,
        ]);
        $builder->add('submit', SubmitType::class);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'Team' => null,
            'data_class' => 'AppBundle\Entity\Team'
        ]);
    }


    public function getBlockPrefix()
    {
        return 'Team';
    }


}
