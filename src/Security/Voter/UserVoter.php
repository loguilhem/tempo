<?php

namespace App\Security\Voter;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    /**
     * @var Company
     */
    private $companySession;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        if ($session->get('_company')) {
            $this->companySession = $em->getRepository(Company::class)->find($session->get('_company'));
        }
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['edit']) && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'edit':
                return $user->getCompanies()->contains($this->companySession);
        }

        return false;
    }
}
