<?php

/*This controller to add, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Worker;
use AppBundle\Form\WorkerType;
use AppBundle\Entity\Dossier;
use AppBundle\Form\DossierType;
use AppBundle\Entity\Tache;
use AppBundle\Form\TacheType;
use AppBundle\Entity\Temps;
use AppBundle\Form\TempsType;
use Symfony\Component\Routing\Annotation\Route;

class TablesController extends Controller
{
    /**
     * @Route(path="/add_dossiers", name="adddossier", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addDossierAction(Request $request)
    {
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dossier = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($dossier);
            $em->flush();
            $this->addFlash('success', 'Dossier correctement ajouté.');
            return $this->redirectToRoute('listdossier');
        }

        return $this->render('add:dossier.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/add_taches", name="addtache", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addTacheAction(Request $request)
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tache = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Tâche correctement ajoutée.');
            return $this->redirectToRoute('listtache');
        }

        return $this->render('add:tache.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/add_temps", name="addtemps", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function addTempsAction(Request $request)
    {
        $temps = new Temps();
        $form = $this->createForm(TempsType::class, $temps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $temps = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $collaborateur = $this->get('security.token_storage')->getToken()->getUser();

            /*$date = $form["date"]->format('Y-m-d');
            $temps->setUserMod($date);*/
            $temps->setCollaborateur($collaborateur);
            $em->persist($temps);
            $em->flush();
            $this->addFlash('success', 'Temps passé correctement ajouté.');

            if (false === $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')){
                return $this->redirectToRoute('listtempscollaborateur');
            }
            return $this->redirectToRoute('listtemps');

        }

        return $this->render('add:temps.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route(path="/mod_dossier/{id}", name="moddossier", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modDossierAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Dossier');
        $dossier = $repository->find($id);
        
        if(null === $dossier)
        {
            $this->addFlash('error', 'Le dossier avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listdossier');
        }
        
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Le dossier a été correctement modifé.');
            return $this->redirectToRoute('listdossier');
        }
        
        return $this->render('mod:dossier.html.twig', array('form' => $form->createView()));        
    }
    
    /**
     * @Route(path="/mod_tache/{id}", name="modtache", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modTacheAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Tache');
        $tache = $repository->find($id);
        
        if(null === $tache)
        {
            $this->addFlash('error', 'La tâche avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listtache');
        }
        
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La tâche a été correctement modifée.');
            return $this->redirectToRoute('listtache');
        }
        
        return $this->render('mod:tache.html.twig', array('form' => $form->createView()));        
    }
    
    /**
     * @Route(path="/mod_temps/{id}", name="modtemps", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function modTempsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Temps');
        $temps = $repository->find($id);
        
        if(null === $temps)
        {
            $this->addFlash('error', 'La ligne temps passé avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listtempscollaborateur');
        }


        $tempsCollaborateur = $temps->getCollaborateur();
        $currentCollaborateur = $this->get('security.token_storage')->getToken()->getUser();

        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') && $tempsCollaborateur != $currentCollaborateur) {
            $this->addFlash('error', 'Vous n\'avez pas les droits pour modifier ce temps passé');
            return $this->redirectToRoute('listtempscollaborateur');
        }
        
        $form = $this->createForm(TempsType::class, $temps);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ligne temps passé a été correctement modifée.');
            return $this->redirectToRoute('listtempscollaborateur');
        }
        
        return $this->render('mod:temps.html.twig', array('form' => $form->createView()));        
    }
    
    /**
     * @Route(path="/del_dossier/{id}", name="deldossier", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function delDossierAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Dossier');
        $dossier = $repository->find($id);
        
        if(null === $dossier)
        {
            $this->addFlash('error', 'Le dossier avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listdossier');
        }
        
            $em->remove($dossier);
            $em->flush();
            $this->addFlash('success', 'Dossier correctement supprimée.');
            return $this->redirectToRoute('listdossier');
    }
    
    /**
     * @Route(path="/del_tache/{id}", name="deltache", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function delTacheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Tache');
        $tache = $repository->find($id);
        
        if(null === $tache)
        {
            $this->addFlash('error', 'La tâche avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listtache');
        }
        
            $em->remove($tache);
            $em->flush();
            $this->addFlash('success', 'Tâche correctement supprimée.');
            return $this->redirectToRoute('listtache');
    }
    
    /**
     * @Route(path="/del_temps/{id}", name="deltemps", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function delTempsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Temps');
        $temps = $repository->find($id);
        
        if(null === $temps)
        {
            $this->addFlash('error', 'La ligne temps passé avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listtempscollaborateur');
        }

        $tempsCollaborateur = $temps->getCollaborateur();
        $currentCollaborateur = $this->get('security.token_storage')->getToken()->getUser();

        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') && $tempsCollaborateur != $currentCollaborateur) {
            $this->addFlash('error', 'Vous n\'avez pas les droits pour supprimer ce temps passé');
            return $this->redirectToRoute('listtempscollaborateur');
        }
        
            $em->remove($temps);
            $em->flush();
            $this->addFlash('success', 'La ligne temps passée correctement supprimée.');
            return $this->redirectToRoute('listtempscollaborateur');
    }
}
