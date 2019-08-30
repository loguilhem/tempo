<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class  Recap2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('collaborateur', EntityType::class, array(
                    'class' => 'UserBundle:User',
                    'expanded' => false,
                    'multiple' => false,
                    'choice_label' => function($collaborateur){
                        $nom = $collaborateur->getUserName();
                        return $nom;
                    },
                    'attr' => array(
                        'class' => 'chosen-select'
                    )
                ))
                ->add('exercice', ChoiceType::class, array(
                    'choices' => array(
                        '2016' => 2016,
                        '2017' => 2017,
                        '2018' => 2018,
                        '2019' => 2019,
                        '2020' => 2020,
                ),
                    'attr' => array(
                        'class' => 'chosen-select'
                    )
                ))
                ->add('forever', CheckboxType::class, array(
                    'label' => 'TOUT',
                    'required' => false,
                    'data' => false,
                    'attr' => array(
                        'class' => 'disDatePickForm2'
                    )
                ))
                ->add('date_debut', DateType::class, array(
                    'widget' => 'single_text',
                    'data' => new \DateTime(),
                    'required' => true,
                    'html5' => false,
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datePick form2')
                ))
                ->add('date_fin', DateType::class, array(
                    'widget' => 'single_text',
                    'data' => new \DateTime(),
                    'required' => true,
                    'html5' => false,
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datePick form2')
                ))
                ->add('filtrer', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_recap2';
    }


}