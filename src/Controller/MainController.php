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
}
