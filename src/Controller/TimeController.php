<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Entity\Time;
use Form\TimeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Security\Core\Security as SecurityUser;

class TimeController extends Controller
{
    /**
     * @Route(path="/list-times", name="listtimes", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listTimes(Request $request, EntityManagerInterface $entityManager, SecurityUser $security)
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $times = $entityManager->getRepository(Time::class)->findAll();
        } else {
            $times = $entityManager->getRepository(Time::class)->findBy([
                'user' => $security->getUser()
            ]);
        }

        return $this->render('lists/times.html.twig', [
            'times' => $times,
            'timeToDelete' => $request->request->get('timeToDelete')
        ]);
    }
    /**
     * @Route(path="/add-time", name="addtime", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function addTime(Request $request, EntityManagerInterface $entityManager, SecurityUser $security, FlashBagInterface $flashBag, TranslatorInterface $translator)
    {
        $time = new Time();
        $form = $this->createForm(TimeType::class, $time);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $time->setUser($security->getUser());
            $entityManager->persist($time);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Time passé correctement ajouté.'));

            return $this->redirectToRoute('listtimes');
        }

        return $this->render('form/time.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route(path="/{id}/mod-time", name="modtime", methods={"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function modTempsAction(Request $request, int $id, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TranslatorInterface $translator)
    {
        $time = $entityManager->getRepository(Time::class)->find($id);
        $form = $this->createForm(TimeType::class, $time);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Ligne temps passé a été correctement modifée.'));

            return $this->redirectToRoute('listtimes');
        }

        return $this->render('form/time.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route(path="/delete_time", name="deltime", methods={"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function delTime(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $time = $entityManager->getRepository(Time::class)->find($request->request->get('id'));
        $entityManager->remove($time);
        $entityManager->flush();
        $flashBag->add('success', $translator->trans('La ligne temps passée correctement supprimée.'));

        return $this->redirectToRoute('listtimes');
    }
}
