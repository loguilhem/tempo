<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class TimeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $datetimeWidget = 'single_text';
        if ($options['isMobile']) {
            $datetimeWidget = 'choice';
        }

        $builder
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choices' => $options['projects'],
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($project) {
                    return $project->getName();
                },
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('task', EntityType::class, [
                'class' => Task::class,
                'choices' => $options['tasks'],
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('startTime', DateTimeType::class, [
                'widget' => $datetimeWidget,
                'required' => true,
            ])
            ->add('endTime', DateTimeType::class, [
                'widget' => $datetimeWidget,
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Time::class,
            'projects' => [],
            'tasks' => [],
            'translation_domain' => 'forms',
            'isMobile' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_time';
    }
}
