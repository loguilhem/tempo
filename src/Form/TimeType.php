<?php

namespace App\Form;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use AppBundle\Entity\Time;
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
            ->add('date', DateType::class, array(
                    'widget' => 'single_text',
                    'data' => new \DateTime(),
                    'required' => true,
                    'html5' => false,
                    'format' => 'dd-MM-yyyy',
                ))
            ->add('project', EntityType::class, array(
                    'class' => Project::class,
                    'expanded' => false,
                    'multiple' => false,
                    'choice_label' => function($project) {
                        return $project->getName();
                    },
                ))
            ->add('task', EntityType::class, array(
                    'class' => Task::class,
                    'expanded' => false,
                    'multiple' => false,
                    'choice_label' => function($task) {
                        return $task->getName();
                    },
                ))
            ->add('time', NumberType::class, [

            ])
            ->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Time::class
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
