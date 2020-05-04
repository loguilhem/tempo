<?php

namespace App\Controller;

use Form\Calc1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

class CalcController extends AbstractController
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
    public function renderCalc1()
    {
        $this->redirectToRoute('calc');
    }
    
}
