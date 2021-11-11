<?php

namespace App\Controller;

use App\Entity\Company;
use App\Service\CompanyService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(path="/", name="index", methods={"GET"})
     * @return Response
     */
    public function index(
        Request $request,
        SessionInterface $session,
        EntityManagerInterface $em,
        CompanyService $companyService
    ): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            $companyService->setSession($request, $session, $this->getUser(), null);
            return $this->render('page/dashboard.html.twig');
        } else {
            return $this->render('page/index.html.twig');
        }
    }

    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     *
     * @param $locale
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeLocale($locale, Request $request): RedirectResponse
    {
        // Save locale in session
        $request->getSession()->set('_locale', $locale);

        // Back to visited page
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/company_select/{company}", name="company_select")
     *
     * @param Request $request
     * @param SessionInterface $session
     * @param Company $company
     * @return RedirectResponse
     */
    public function companySelect(
        Request $request,
        SessionInterface $session,
        Company $company
    ): RedirectResponse
    {
        $session->set('_company', $company->getId());

        $response = new RedirectResponse($request->headers->get('referer'));
        $response
            ->prepare($request)
            ->setStatusCode(200)
            ->headers
            ->setCookie(new Cookie('_company', $company->getId(), time() + (10 * 24 * 60 * 60)))
        ;

        return $response;
    }
}
