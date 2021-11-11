<?php

namespace App\Security\Voter;

use App\Entity\Company;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskVoter extends Voter
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

    protected function supports($attribute, $subject): bool
    {
        return in_array($attribute, ['add', 'view', 'edit', 'delete'])
            && $subject instanceof Task;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'add':
            case 'view':
            case 'edit':
            case 'delete':
                return $user->getCompanies()->contains($this->companySession);
        }

        return false;
    }
}
