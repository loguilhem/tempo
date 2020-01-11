<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('numero')
                ->add('tachemere', EntityType::class, array(
                        'class' => 'Task.php',
                        'expanded' => false,
                        'multiple' => false,
                        'choice_label' => function($tache){
                                        $int_tache = $tache->getIntitule();
                                        $num_tache = $tache->getNumero();
                                        $tache_full = $num_tache . ' ' . $int_tache;
                                        return $tache_full;
                        },
                        'placeholder' => 'pas de tâche mère',
                        'required' => false,
                        'attr' => array(
                            'class' => 'chosen-select'
                        )
                                
                ))               
                ->add('Enregistrer', SubmitType::class);;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Task'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tache';
    }


}
