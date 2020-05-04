<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class TaskController
 * @package App\Controller
 * @Route("/task")
 */
class TaskController extends AbstractController
{
    /**
     * @Route(path="/list", name="list_tasks", methods={"GET", "POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function listTasks(EntityManagerInterface $entityManager, Request $request)
    {
        return $this->render('task/list.html.twig', [
            'tasks' => $entityManager->getRepository(Task::class)->findBy([
                'company' => $this->getUser()->getCompany()
            ]),
            'taskToDelete' => $request->request->get('taskToDelete')
        ]);
    }

    /**
     * @Route(path="/add", name="add_task", methods={"GET", "POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function add(
        Request $request,
        FlashBagInterface $flashBag,
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator
    )
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task, [
            'choices' => $entityManager->getRepository(Task::class)->findBy([
                'company' => $this->getUser()->getCompany()
            ])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCompany($this->getUser()->getCompany());
            $entityManager->persist($task);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Task added'));

            return $this->redirectToRoute('list_tasks');
        }

        return $this->render('task/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/{id}/edit", name="edit_task", methods={"GET", "POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     * @ParamConverter("task", class="App\Entity\Task")
     */
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator,
        Task $task)
    {
        $this->denyAccessUnlessGranted('edit', $task);

        $choices = $entityManager->getRepository(Task::class)->findExceptItself($task, $this->getUser()->getCompany());
        $form = $this->createForm(TaskType::class, $task, [
            'choices' => $choices
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Task edited'));

            return $this->redirectToRoute('list_tasks');
        }
        
        return $this->render('task/form.html.twig', array('form' => $form->createView()));
    }
    

    /**
     * @Route(path="/delete", name="delete_task", methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function delete(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $task = $entityManager->getRepository(Task::class)->find($request->request->get('id'));
        $this->denyAccessUnlessGranted('delete', $task);

        $entityManager->remove($task);
        $entityManager->flush();

        $flashBag->add('success', $translator->trans('Task deleted.'));

        return $this->redirectToRoute('list_tasks');
    }
}
