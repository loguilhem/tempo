<?php

namespace App\Security\Voter;

use App\Entity\Time;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class TimeVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['edit', 'delete'])
            && $subject instanceof Time;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'edit':
                return $this->canEdit($user, $subject);
            case 'delete':
                return $this->canDelete($user, $subject);
        }

        return false;
    }

    private function canEdit($user, $subject)
    {
        if ($user === $subject->getUser() || $this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    private function canDelete($user, $subject)
    {
        if ($user === $subject->getUser() || $this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }
}
