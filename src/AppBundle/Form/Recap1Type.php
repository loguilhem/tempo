<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class  Recap1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dossier', EntityType::class, array(
                'class' => 'AppBundle:Dossier',
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($dossier){
                    return $dossier->getNom().' '.$dossier->getNumero();
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
                    'class' => 'disDatePickForm1'
                )
            ))
            ->add('date_debut', DateType::class, array(
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => false,
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'class' => 'datePick form1')
            ))
            ->add('date_fin', DateType::class, array(
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => false,
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'class' => 'datePick form1')
            ))
            ->add('=>', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_recap1';
    }


}