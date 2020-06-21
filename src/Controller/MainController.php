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
        return $this->render('index.html.twig');
    }
    
    /**
     * @Route(path="/recap", name="recap", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function Recap(Request $request, EntityManagerInterface $entityManager)
    {
        /* there are 2 filters available, each one is a form: recap1Type, recap2Type */
        $repoTemps = $entityManager->getRepository(Time::class);

        $form1 = $this->createForm(Calc1Type::class);
        $form1->handleRequest($request);


        /* TODO: split forms handle in other functions */

        /*filter 1 : show total Tempspassé for a Project, a Exercice and for each Task */
        if ($form1->isSubmitted() && $form1->isValid()) {
            $data = $form1->getData();
            $idDossier = $data["dossier"]->getId();
            $dossier = $data["dossier"];
            $exercice = $data["exercice"];
            $dateDebut = $data["date_debut"];
            $dateFin = $data["date_fin"];
            $forever = $data["forever"];

            $results = $repoTemps->getSumByDossierExercice($idDossier, $exercice, $dateDebut, $dateFin, $forever);

            $details = $repoTemps->getByDossierExercice($idDossier, $exercice, $dateDebut, $dateFin, $forever);

           return $this->render('results.html.twig',
               array('dossier' => $dossier, 'exercice' => $exercice,
                   'dateDebut' => $dateDebut, 'dateFin' => $dateFin,
                   'results' => $results, 'details' => $details
               ));
        } else {
            return $this->render('recap.html.twig', [
                'form1' => $form1->createView(),
            ]);
        }
    }
    
}
