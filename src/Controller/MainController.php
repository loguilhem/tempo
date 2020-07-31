<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(path="/", name="index", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        if ($this->isGranted('ROLE_USER')) {
            return $this->render('page/dashboard.html.twig');
        } else {
            return $this->render('page/index.html.twig');
        }
    }

    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     *
     * @param $locale
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changeLocale($locale, Request $request)
    {
        // Save locale in session
        $request->getSession()->set('_locale', $locale);

        // Back to visited page
        return $this->redirect($request->headers->get('referer'));
    }
}
