<?php

namespace AppBundle\Form;

use AppBundle\Entity\Matches;
use AppBundle\Form\MatchesType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MatchesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('localgoals', IntegerType::class, [
            'label'     => 'Goles del local',
            'required'  => false,
        ]);

        $builder->add('visitgoals', IntegerType::class, [
            'label'     => 'Goles del visitante',
            'required'  => false,
        ]);

        $builder->add('localteam',EntityType::class, [
            'class'         => 'AppBundle\Entity\Team',
            'choice_label'  => 'name',
            'label'         => 'Equipo Local',
            'placeholder'   => 'Seleccione equipo local',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('t')
                          ->orderBy('t.name', 'ASC');
            }
        ]);

        $builder->add('visitteam',EntityType::class, [
            'class'         => 'AppBundle\Entity\Team',
            'choice_label'  => 'name',
            'label'         => 'Equipo Visitante',
            'required'      => true,
            'placeholder'   => 'Seleccione equipo visitante',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('t')
                          ->orderBy('t.name', 'ASC');
            }
        ]);

        $builder->add('date', DateTimeType::class, [
            'label'     => 'Fecha y hora',
            'required'  => false
        ]);

        $builder->add('submit', SubmitType::class);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'Matches' => null,
            'data_class' => 'AppBundle\Entity\Matches'
        ]);
    }


    public function getBlockPrefix()
    {
        return 'Matches';
    }


}
