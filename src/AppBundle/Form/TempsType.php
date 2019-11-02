<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class TempsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder->add('date', DateType::class, array(
                        'widget' => 'single_text',
                        'data' => new \DateTime(),
                        'required' => true,
                        'html5' => false,
                        'format' => 'dd-MM-yyyy',
                        'attr' => array(
                            'class' => 'datePick')
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
                ->add('dossier', EntityType::class, array(
                        'class' => 'AppBundle:Dossier',
                        'expanded' => false,
                        'multiple' => false,
                        'choice_label' => function($dossier){
                                        $nomDossier = $dossier->getNom();
                                        $numDossier = $dossier->getNumero();
                                        return $numDossier.' '.$nomDossier;
                        },
                        'attr' => array(
                            'class' => 'chosen-select'
                        )
                ))
                ->add('tache', EntityType::class, array(
                        'class' => 'AppBundle:Tache',
                        'expanded' => false,
                        'multiple' => false,
                        'choice_label' => function($tache){
                                        $int_tache = $tache->getIntitule();
                                        $num_tache = $tache->getNumero();
                                        $tache_full = $num_tache . ' ' . $int_tache;
                                        return $tache_full;
                        },
                        'attr' => array(
                            'class' => 'chosen-select'
                        )
                ))
                ->add('tempspasse')                
                ->add('+', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Temps'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_temps';
    }


}
