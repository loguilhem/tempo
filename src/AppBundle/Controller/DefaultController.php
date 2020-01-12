<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Time;
use AppBundle\Form\Recap2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Security as SecurityUser;
use AppBundle\Form\Recap1Type;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="index", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {        
        return $this->render('index.html.twig');
    }

    /**
     * @Route(path="list_temps_collaborateur", name="listtempscollaborateur", methods={"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function listTempsCollaborateurAction(EntityManagerInterface $entityManager, SecurityUser $security)
    {
        return $this->render('times.html.twig', [
            'times' => $entityManager->getRepository(Time::class)->findByCollaborateur($security->getUser())
        ]);
    }

    /**
     * @Route(path="list_tout_temps_collaborateur", name="listalltempscollaborateur", methods={"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function listToutTempsCollaborateurAction(EntityManagerInterface $entityManager, SecurityUser $security)
    {
        if (false === $security->isGranted('ROLE_SUPER_ADMIN')) {
            $listTempsQuery = $entityManager->getRepository(Time::class)->findByCollaborateur($security->getUser());
        } else {
            $listTempsQuery = $entityManager->getRepository(Time::class)->findAll();
        }

        return $this->render('alltimes.html.twig', [
            'listTemps' => $listTempsQuery
        ]);
    }
    
    /**
     * @Route(path="/recap", name="recap", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function RecapAction(Request $request, EntityManagerInterface $entityManager)
    {
        /* there are 2 filters available, each one is a form: recap1Type, recap2Type */
        $repoTemps = $entityManager->getRepository(Time::class);

        $form1 = $this->createForm(Recap1Type::class);
        $form1->handleRequest($request);

        $form2 = $this->createForm(Recap2Type::class);
        $form2->handleRequest($request);

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
        }

        /*filter 2 : show total Tempspassé for a Exercice, a Worker and for each Project */

        elseif ($form2->isSubmitted() && $form2->isValid()) {
            $data = $form2->getData();

            $idCol = $data["collaborateur"]->getId();
            $col = $data["collaborateur"];
            $exercice = $data["exercice"];
            $dateDebut = $data["date_debut"];
            $dateFin = $data["date_fin"];
            $forever = $data["forever"];

            $results2 = $repoTemps->getSumByColExercice($idCol, $exercice, $dateDebut, $dateFin, $forever);
            $details2 = $repoTemps->getByColExercice($idCol, $exercice, $dateDebut, $dateFin, $forever);

            return $this->render('results.html.twig', [
                    'collaborateur' => $col, 'exercice' => $exercice,
                    'dateDebut' => $dateDebut, 'dateFin' => $dateFin,
                    'results2' => $results2, 'details' => $details2,
            ]);
        } else {
            return $this->render('recap.html.twig', [
                'form1' => $form1->createView(),
                'form2' => $form2->createView(),
            ]);
        }
    }
    
}
