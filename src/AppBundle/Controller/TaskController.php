<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace AppBundle\Controller;

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
     * @Route(path="/list-tasks", name="listtasks", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listTasks(EntityManagerInterface $entityManager, Request $request)
    {
        return $this->render('lists/tasks.html.twig', [
            'tasks' => $entityManager->getRepository(Task::class)->findAll(),
            'taskToDelete' => $request->request->get('taskToDelete')
        ]);
    }

    /**
     * @Route(path="/add-task", name="addtask", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addTask(Request $request, FlashBagInterface $flashBag, TranslatorInterface $translator, EntityManagerInterface $entityManager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task, [
            'choices' => $entityManager->getRepository(Task::class)->findAll()
        ]);
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
     * @Route(path="/{id}/mod-task", name="modtask", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modTask(Request $request, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TranslatorInterface $translator, $id)
    {
        $repo = $entityManager->getRepository(Task::class);
        $task = $repo->find($id);
        $choices = $repo->findExceptItself($id);
        $form = $this->createForm(TaskType::class, $task, [
            'choices' => $choices
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('La tâche a été correctement modifée.'));
            return $this->redirectToRoute('listtasks');
        }
        
        return $this->render('form/task.html.twig', array('form' => $form->createView()));
    }
    

    /**
     * @Route(path="/delete-task", name="deltask", methods={"POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function delTask(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $task = $entityManager->getRepository(Task::class)->find($request->request->get('id'));
        $entityManager->remove($task);
        $entityManager->flush();
        $flashBag->add('success', $translator->trans('Task deleted.'));

        return $this->redirectToRoute('listtasks');
    }
}
