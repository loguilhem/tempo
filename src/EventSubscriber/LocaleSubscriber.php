<?php

namespace App\EventSubscriber;

use App\Kernel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    // Default locale
    private $defaultLocale;

    public function __construct($defaultLocale = 'fr')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }

        // We use locale passed as param, if any
        if ($locale = $request->query->get('_locale')) {
            $request->setLocale($locale);
        } else {
            // else we use session's locale
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            //RequestEvent::class => 'onRequestEvent',

            // We must set a high priority
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
