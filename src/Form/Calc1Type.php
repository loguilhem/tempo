<?php

namespace App\Form;

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
        $builder
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($project){
                    return $project->getName();
                },
                'placeholder' => '-- All --',
                'empty_data' => -1,
                'required' => false
            ])
            ->add('task', EntityType::class, [
                'class' => Task::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function($task) {
                    return $task->getName();
                },
                'placeholder' => '-- All --',
                'empty_data' => -1,
                'required' => false
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => function ($user) {
                    return  $user->getUsername();
                },
                'placeholder' => '-- All --',
                'empty_data' => -1,
                'required' => false
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'required' => false
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'required' => false,
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'required' => false
            ])
            ->add('forever', CheckboxType::class, [
                'label' => 'No time limit',
                'required' => false
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
