<?php
// src/AppBundle/Form/EventListener/AddEmailFieldListener.php
namespace App\Form\EventListener;

use App\Form\CompanyType;
use App\Form\CompanyKeyType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AccountTypeListener implements EventSubscriberInterface
{
    private $roles;

    public function __construct(string $role = null)
    {
        $this->roles[] = $role;
    }
    /**
     * getSubscribedEvents
     *
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
        ];
    }


    /**
     * onPreSetData
     *
     * @param  FormEvent $event
     *
     * @return void
     */
    public function onPreSetData(FormEvent $event): void
    {
        $this->formRoleModifier($event->getForm(), $this->roles);
    }


    /**
     * formRoleModifier
     *
     * @param  FormInterface $form
     * @param  array $roles
     * 
     * @return void
     */
    private function formRoleModifier(FormInterface $form, array $roles = []): void
    {
        dump($roles);
        if(in_array('ROLE_SUPER_ADMIN', $roles) || $roles[0] == null)
        {
            $form
                ->add('Company', CompanyType::class, [
                    'label' => false
                ]);
        }

        if(in_array('ROLE_USER', $roles)) 
        {
            $form
                ->add('token', CompanyKeyType::class, [
                    'mapped' => false,
                    'label' => false
                ]);
        }
    }
}
