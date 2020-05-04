<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use Symfony\Component\Form\AbstractType;
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
        $builder
            ->add('project', EntityType::class, array(
                'class' => Project::class,
                'choices' => $options['projects'],
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($project) {
                    return $project->getName();
                },
            ))
            ->add('task', EntityType::class, array(
                'class' => Task::class,
                'choices' => $options['tasks'],
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($task) {
                    return $task->getName();
                },
            ))
            ->add('startTime', DateType::class, array(
                    'widget' => 'single_text',
                    'data' => new \DateTime(),
                    'required' => true,
                    'html5' => false,
                    'format' => 'dd-MM-yyyy HH:ss',
                ))
            ->add('endTime', DateType::class, array(
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => true,
                'html5' => false,
                'format' => 'dd-MM-yyyy HH:ss',
            ))
            ->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Time::class,
            'projects' => [],
            'tasks' => [],
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_time';
    }
}
