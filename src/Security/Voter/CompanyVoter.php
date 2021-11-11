<?php

namespace App\Security\Voter;

use App\Entity\Company;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CompanyVoter extends Voter
{
    /**
     * @var ParameterBag
     */
    private $allowAddCompany;

    /**
     * @param ParameterBagInterface $bag
     */
    public function __construct(string $allowAddCompany)
    {
        $this->allowAddCompany = $allowAddCompany;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['add', 'edit', 'view'])
            && $subject instanceof Company;
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
            case 'view':
            case 'edit':
                return $this->isAllowedToEdit($user->getCompanies(), $subject);
            case 'add':
                return $this->isAllowedToAdd();
        }

        return false;
    }

    private function isAllowedToAdd(): bool
    {
        return (bool) $this->allowAddCompany;
    }

    private function isAllowedToEdit(Collection $companies, Company $company): bool
    {
        if ($companies->contains($company)) {
            return true;
        }

        return false;
    }
}
