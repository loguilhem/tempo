<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{

    /**
     * @Route("/", name="company_show", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function show(): Response
    {
        return $this->render('page/company/show.html.twig', [
            'company' => $this->getUser()->getCompanies(),
        ]);
    }

    /**
     * @Route("/edit", name="company_add", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $company = new Company();

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('company_show');
        }

        return $this->render('page/company/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit", name="company_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CompanyType::class, $this->getUser()->getCompanies());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('company_show');
        }

        return $this->render('page/company/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
