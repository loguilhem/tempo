<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use AppBundle\Entity\Time;
use AppBundle\Form\TimeType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class TablesController extends Controller
{
    /**
     * @Route(path="/add-project", name="addproject", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addProject(Request $request, FlashBagInterface $flashBag, TranslatorInterface $translator, EntityManagerInterface $entityManager)
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $entityManager->persist($project);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('project.added'));
            return $this->redirectToRoute('listprojects');
        }

        return $this->render('form/project.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/add-task", name="addtask", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addTask(Request $request, FlashBagInterface $flashBag, TranslatorInterface $translator, EntityManager $entityManager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tache = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Tâche correctement ajoutée.');
            return $this->redirectToRoute('listtache');
        }

        return $this->render('task.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/add_temps", name="addtemps", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function addTempsAction(Request $request)
    {
        $temps = new Time();
        $form = $this->createForm(TimeType::class, $temps);
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
            $this->addFlash('success', 'Time passé correctement ajouté.');

            if (false === $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')){
                return $this->redirectToRoute('listtempscollaborateur');
            }
            return $this->redirectToRoute('listtemps');
        }

        return $this->render('time.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route(path="/{id}/project/", name="modproject", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modProject(Request $request, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TranslatorInterface $translator, $id)
    {
        $project = $entityManager->getRepository(Project::class)->find($id);
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Le projet a été correctement modifé.'));
            return $this->redirectToRoute('listprojects');
        }
        
        return $this->render('form/project.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/mod_tache/{id}", name="modtache", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modTacheAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Task');
        $tache = $repository->find($id);
        
        if(null === $tache)
        {
            $this->addFlash('error', 'La tâche avec l\'ID '.$id.' n\'existe pas.');
            return $this->redirectToRoute('listtache');
        }
        
        $form = $this->createForm(TaskType::class, $tache);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La tâche a été correctement modifée.');
            return $this->redirectToRoute('listtache');
        }
        
        return $this->render('task.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route(path="/mod_temps/{id}", name="modtemps", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function modTempsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Time');
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
        
        $form = $this->createForm(TimeType::class, $temps);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ligne temps passé a été correctement modifée.');
            return $this->redirectToRoute('listtempscollaborateur');
        }
        
        return $this->render('time.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route(path="/del-project/", name="delproject", methods={"DELETE"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function delProject(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Project::class);
        $entityManager->flush();
        $this->addFlash('success', 'Project correctement supprimée.');
        return $this->redirectToRoute('listdossier');
    }
    
    /**
     * @Route(path="/del_tache/{id}", name="deltache", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function delTacheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Task');
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
        $repository = $em->getRepository('Time');
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
