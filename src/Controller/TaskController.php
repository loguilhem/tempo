<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @var Company
     */
    private $companySession;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->companySession = $em->getRepository(Company::class)->find($session->get('_company'));
        $this->em = $em;
    }

    /**
     * @Route(path="/list", name="list_tasks", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function listTasks(Request $request): Response
    {
        return $this->render('page/task/list.html.twig', [
            'tasks' => $this->em->getRepository(Task::class)->findBy([
                'company' => $this->companySession
            ]),
            'taskToDelete' => $request->request->get('taskToDelete')
        ]);
    }

    /**
     * @Route(path="/add", name="add_task", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function add(
        Request $request,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task, [
            'choices' => $this->em->getRepository(Task::class)->findBy([
                'company' => $this->companySession
            ])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCompany($this->companySession);
            $this->em->persist($task);
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Task added'));

            return $this->redirectToRoute('list_tasks');
        }

        return $this->render('page/task/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/{id}/edit", name="edit_task", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     * @ParamConverter("task", class="App\Entity\Task")
     */
    public function edit(
        Request $request,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator,
        Task $task)
    {
        $this->denyAccessUnlessGranted('edit', $task);

        $choices = $this->em->getRepository(Task::class)->findExceptItself($task, $this->getUser()->getCompanies());
        $form = $this->createForm(TaskType::class, $task, [
            'choices' => $choices
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Task edited'));

            return $this->redirectToRoute('list_tasks');
        }
        
        return $this->render('page/task/form.html.twig', array('form' => $form->createView()));
    }
    

    /**
     * @Route(path="/delete", name="delete_task", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $task = $entityManager->getRepository(Task::class)->find($request->request->get('id'));
        $this->denyAccessUnlessGranted('delete', $task);

        if (!count($task->getTimes()) > 0 && !count($task->getDaughterTasks()) > 0) {
            $entityManager->remove($task);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Task deleted'));
        } else {
            $flashBag->add('error', $translator->trans('task.cannot_msg'));
        }

        return $this->redirectToRoute('list_tasks');
    }
}
