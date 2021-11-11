<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class CompanyService
{
    /**
     * @var User
     */
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }


    public function setSession(
        Request          $request,
        SessionInterface $session,
        ?Company $company
    ): void
    {
        if ($company) {
            $session->set('_company', $company->getId());

            return;
        }

        if ($request->cookies->get('_company')) {
            $session->set('_company', $request->cookies->get('_company'));
        } else {
            $lastCompany = $this->user->getCompanies();
            $session->set('_company', $lastCompany[0]->getId());
        }
    }
}