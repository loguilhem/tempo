<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Time;
use AppBundle\Form\Recap2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security as SecurityUser;
use AppBundle\Form\Calc1Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class CalcController extends Controller
{
    /**
     * @Route(path="/calc", name="calc", methods={"GET", "POST"})
     * @Security("has-role('ROLE_SUPER_ADMIN')")
     */
    public function index()
    {
        $form = $this->createForm(Calc1Type::class, null, [
            'method' => 'post',
            'action' => $this->generateUrl('result-calc1')
        ]);

        return $this->render('form/calc.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/result/calc1", name="result-calc1", methods={"POST"})
     */
    public function renderCalc1(Request $request, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TranslatorInterface $translator)
    {
        $form = $request->request;
        dump($form);
        $this->redirectToRoute('calc');
    }
    
}
