<?php


namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;

class UserService
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param $currentUser
     * @param $targetUser
     * @return bool
     */
    public function proDemotePossible($currentUser, $targetUser)
    {
        if ($currentUser != $targetUser) {
            return true;
        } else {
            $this->session->getFlashBag()->add('error', 'On peut pas diminuer ses propres droits.');
            return false;
        }
    }
}