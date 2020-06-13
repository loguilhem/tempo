<?php
// src/AppBundle/Form/EventListener/AddEmailFieldListener.php
namespace App\Form\EventListener;

use App\Form\CompanyType;
use App\Form\CompanyKeyType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AccountTypeListener implements EventSubscriberInterface
{
    /**
     * getSubscribedEvents
     *
     * @return array
     */
    public static function getSubscribedEvents() :array
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    /**
     * onPreSetData
     *
     * @param  FormEvent $event
     *
     * @return void
     */
    public function onPreSetData(FormEvent $event) :void
    {
        $user = $event->getData();

        if(in_array('ROLE_SUPER_ADMIN',$user->getRoles()))
        {
            $event
                ->getForm()
                ->add('Company', CompanyType::class);
        }

        if(in_array('ROLE_USER',$user->getRoles())) 
        {
            $event
                ->getForm()
                ->add('CompanyKey', CompanyKeyType::class, [
                    'mapped' => false,
                ]);
        }
    }

    /**
     * onPreSetData
     *
     * @param  FormEvent $event
     *
     * @return void
     */
    public function onPreSubmit(FormEvent $event) :void
    {
        $data = $event->getData();

        if('ROLE_SUPER_ADMIN' === $data['accountType'])
        {
            $event
                ->getForm()
                ->add('Company', CompanyType::class);
        }

        if('ROLE_USER' === $data['accountType'] ) 
        {
            $event
                ->getForm()
                ->add('CompanyKey', CompanyKeyType::class, [
                    'mapped' => false,
                ]);
        }
    }
}
