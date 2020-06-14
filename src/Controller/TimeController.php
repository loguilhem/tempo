<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use App\Form\TimeType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class TimeController
 * @package App\Controller
 * @Route("time")
 */
class TimeController extends AbstractController
{
    /**
     * @Route(path="/list", name="list_times", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function listTimes(Request $request, EntityManagerInterface $entityManager)
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $times = $entityManager->getRepository(Time::class)->getByCompany($this->getUser()->getCompany());
        } else {
            $times = $entityManager->getRepository(Time::class)->findBy([
                'user' => $this->getUser()
            ]);
        }

        return $this->render('time/list.html.twig', [
            'times' => $times,
            'timeToDelete' => $request->request->get('timeToDelete')
        ]);
    }
    /**
     * @Route(path="/add", name="add_time", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $user = $this->getUser();
        $time = new Time();
        $form = $this->createForm(TimeType::class, $time, [
            'projects' => $entityManager->getRepository(Project::class)->findBy([
                'company' => $user->getCompany()
            ]),
            'tasks' => $entityManager->getRepository(Task::class)->findBy([
                'company' => $user->getCompany()
            ])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $time->setUser($user);
            $entityManager->persist($time);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Time added'));

            return $this->redirectToRoute('list_times');
        }

        return $this->render('time/form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route(path="/{id}/edit", name="edit_time", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     * @ParamConverter("time", class="App\Entity\Time")
     */
    public function edit(
        Request $request,
        Time $time,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $this->denyAccessUnlessGranted('edit', $time);

        $form = $this->createForm(TimeType::class, $time, [
            'projects' => $entityManager->getRepository(Project::class)->findBy([
                'company' => $this->getUser()->getCompany()
            ]),
            'tasks' => $entityManager->getRepository(Task::class)->findBy([
                'company' => $this->getUser()->getCompany()
            ])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Time edited'));

            return $this->redirectToRoute('list_times');
        }

        return $this->render('time/form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route(path="/delete", name="delete_time", methods={"POST"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(
        Request $request,
        TranslatorInterface $translator,
        FlashBagInterface $flashBag,
        EntityManagerInterface $entityManager
    )
    {
        $time = $entityManager->getRepository(Time::class)->find($request->request->get('id'));
        $this->denyAccessUnlessGranted('delete', $time);

        $entityManager->remove($time);
        $entityManager->flush();
        $flashBag->add('success', $translator->trans('Time deleted'));

        return $this->redirectToRoute('list_times');
    }
}
