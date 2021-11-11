<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CompanyService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function setSession(
        Request          $request,
        SessionInterface $session,
        User             $user,
        ?Company $company
    )
    {
        if ($company) {
            $session->set('_company', $company->getId());
        }

        if ($request->cookies->get('_company')) {
            $session->set('_company', $request->cookies->get('_company'));
        } else {
            $lastCompany = $user->getCompanies();
            $session->set('_company', $lastCompany[0]->getId());
        }
    }
}