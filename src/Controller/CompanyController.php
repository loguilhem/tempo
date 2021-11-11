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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function show(SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        return $this->render('page/company/show.html.twig', [
            'company' => $entityManager->getRepository(Company::class)->find($session->get('_company')),
        ]);
    }

    /**
     * @Route("/add", name="company_add", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('add', new Company());

        $company = new Company();

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->addMember($this->getUser());

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
    public function edit(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $company = $em->getRepository(Company::class)->find($session->get('_company'));

        $this->denyAccessUnlessGranted('edit', $company);

        $form = $this->createForm(CompanyType::class, $company);
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
