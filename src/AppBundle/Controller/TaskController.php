<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class TaskController extends Controller
{
    /**
     * @Route(path="/list-tasks", name="listtasks", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listTasks(EntityManagerInterface $entityManager, Request $request)
    {
        return $this->render('lists/tasks.html.twig', [
            'tasks' => $entityManager->getRepository(Task::class)->findAll(),
            'taskToDelete' => $request->query->get('taskToDelete')
        ]);
    }

    /**
     * @Route(path="/add-task", name="addtask", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addTask(Request $request, FlashBagInterface $flashBag, TranslatorInterface $translator, EntityManagerInterface $entityManager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager->persist($task);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Tâche correctement ajoutée.'));
            return $this->redirectToRoute('listtasks');
        }

        return $this->render('form/task.html.twig', [
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
}
