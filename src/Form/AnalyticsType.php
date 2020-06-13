<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnalyticsType extends AbstractType
{
    const all = '-- All --';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** TODO: afficher le champ utilisateur que pour le ROLE_ADMIN ou ROLE_SUPER_ADMIN */
        $builder
            ->add('project', ChoiceType::class, [
                'choices' => $options['projects'],
                'choice_value' => 'id',
                'expanded' => false,
                'multiple' => true,
                'choice_label' => 'name',
                'placeholder' => self::all,
                'required' => false,
                'mapped' => false,
            ])
            ->add('task', ChoiceType::class, [
                'choices' => $options['tasks'],
                'expanded' => false,
                'multiple' => true,
                'choice_label' => 'name',
                'placeholder' => self::all,
                'required' => false,
                'mapped' => false,
            ])
            ->add('user', ChoiceType::class, [
                'choices' => $options['users'],
                'expanded' => false,
                'multiple' => true,
                'choice_label' => 'username',
                'placeholder' => self::all,
                'required' => false,
                'mapped' => false,
            ])
            ->add('startTime', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => true,
                'format' => 'yyyy-MM-dd',
            ])
            ->add('endTime', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => true,
                'format' => 'yyyy-MM-dd',
            ])
            ->add('forever', CheckboxType::class, [
                'label' => 'No time limit',
                'required' => false
            ])
            ->add('calculate', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'projects' => null,
            'users' => null,
            'tasks' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_analytics';
    }
}
