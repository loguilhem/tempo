<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use App\Form\TimeType;
use App\Service\MobileService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @Route(path="/list", name="list_times", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function listTimes(Request $request)
    {
        $this->denyAccessUnlessGranted('view', $this->companySession);

        if ($this->isGranted('ROLE_ADMIN')) {
            $times = $this->em->getRepository(Time::class)->getTimes($this->companySession);
        } else {
            $times = $this->em->getRepository(Time::class)->getTimes(
                $this->companySession,
                null,
                null,
                [$this->getUser()]
            );
        }

        return $this->render('page/time/list.html.twig', [
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
        FlashBagInterface $flashBag,
        TranslatorInterface $translator,
        MobileService $mobileService
    )
    {
        $user = $this->getUser();
        $time = new Time();
        $form = $this->createForm(TimeType::class, $time, [
            'projects' => $this->em->getRepository(Project::class)->findBy([
                'company' => $this->companySession
            ]),
            'tasks' => $this->em->getRepository(Task::class)->findBy([
                'company' => $this->companySession
            ]),
            'isMobile' => $mobileService->isMobile($request)
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $time->setUser($user);
            $this->em->persist($time);
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Time added'));

            return $this->redirectToRoute('list_times');
        }

        return $this->render('page/time/form.html.twig', [
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
        FlashBagInterface $flashBag,
        TranslatorInterface $translator,
        MobileService $mobileService
    )
    {
        $this->denyAccessUnlessGranted('edit', $time);

        $form = $this->createForm(TimeType::class, $time, [
            'projects' => $this->em->getRepository(Project::class)->findBy([
                'company' => $this->companySession
            ]),
            'tasks' => $this->em->getRepository(Task::class)->findBy([
                'company' => $this->companySession
            ]),
            'isMobile' => $mobileService->isMobile($request)
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Time edited'));

            return $this->redirectToRoute('list_times');
        }

        return $this->render('page/time/form.html.twig', [
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
        FlashBagInterface $flashBag
    )
    {
        $time = $this->em->getRepository(Time::class)->find($request->request->get('id'));
        $this->denyAccessUnlessGranted('delete', $time);

        $this->em->remove($time);
        $this->em->flush();
        $flashBag->add('success', $translator->trans('Time deleted'));

        return $this->redirectToRoute('list_times');
    }
}
