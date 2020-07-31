<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('address', TextType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('zipCode', NumberType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Country', TextType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('tel', TelType::class, [
                'required' => false,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('token', TextType::class, [
                'required' => false,
                'label_attr' => [
                    'class' => 'control-label'  
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
            'translation_domain' => 'forms',
        ]);
    }
}
