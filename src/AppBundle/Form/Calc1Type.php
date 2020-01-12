<?php

namespace AppBundle\Form;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class  Calc1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('project', EntityType::class, array(
                'class' => Project::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($project){
                    return $project->getName();
                },
                'placeholder' => '-- All --',
            ))
            ->add('task', EntityType::class, array(
                'class' => Task::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($task) {
                    return $task->getName();
                },
                'placeholder' => '-- All --'
            ))
            ->add('user', EntityType::class, [
                'class' => User::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function ($user) {
                    return  $user->getUsername();
                },
                'placeholder' => '-- All --'
            ])
            ->add('startDate', DateType::class, array(
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => false,
                'format' => 'yyyy-MM-dd',
            ))
            ->add('endDate', DateType::class, array(
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => false,
                'format' => 'yyyy-MM-dd',
            ))
            ->add('forever', CheckboxType::class, [
                'label' => 'No time limit'
            ])
            ->add('calculate', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_calc1';
    }


}
