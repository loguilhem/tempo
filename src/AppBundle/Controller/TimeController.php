<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace AppBundle\Controller;

use AppBundle\Entity\Time;
use AppBundle\Form\TimeType;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route(path="/list-times", name="listtimes", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listTimes(Request $request, EntityManagerInterface $entityManager, SecurityUser $security)
    {
        return $this->render('lists/times.html.twig', [
                'times' => $entityManager->getRepository(Time::class)->findBy([
                    'user' => $security->getUser(),
                ]),
            'timeToDelete' => $request->query->get('taskToDelete')

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
