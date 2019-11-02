<?php

namespace AppBundle\Controller;

use AppBundle\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listUsersAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('lists/user.html.twig', array(
            'listUsers' => $users
        ));
    }
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function promoteUserAction($id)
    {
        $currentUser = $this->getUser()->getId();
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);

        if (!$this->get(UserService::class)->proDemotePossible($currentUser, $user->getId())) {
            return $this->redirectToRoute('index');
        } else {
            $currentRole = $user->getHigherRole();
            $newRole = $user->upRole();
            $userManager = $this->get('fos_user.user_manager');
            $user->removeRole($currentRole);
            $user->addRole($newRole);
            $userManager->updateUser($user);

            if($currentRole == $newRole) {
                $this->addFlash('success', 'Utilisateur a déjà tous les droits');
            } else {
                $this->addFlash('success', 'Utilisateur promu');
            }

            return $this->redirectToRoute('listusers');
        }

    }

    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function demoteUserAction($id)
    {
        $currentUser = $this->getUser()->getId();
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);

        if (!$this->get(UserService::class)->proDemotePossible($currentUser, $user->getId())) {
            return $this->redirectToRoute('index');
        } else {
            $currentRole = $user->getHigherRole();
            $newRole = $user->downRole();
            $userManager = $this->get('fos_user.user_manager');
            $user->removeRole($currentRole);
            $user->addRole($newRole);
            $userManager->updateUser($user);
            if ($currentRole == $newRole) {
                $this->addFlash('success', 'Utilisateur est déjà au minimum de droits');
            } else {
                $this->addFlash('success', 'Utilisateur destitué');
            }

            return $this->redirectToRoute('listusers');
        }
    }

    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function activateUserAction($id)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->find($id);
        $locked = $user->isEnabled();

        if($locked == 0) {
            $user->setEnabled(1);
            $this->addFlash('success', 'L\'utilisateur est actif');
        } else {
            $user->setEnabled(0);
            $this->addFlash('success', 'L\'utilisateur est bloqué');
        }
        $userManager = $this->get('fos_user.user_manager');
        $userManager->updateUser($user);

        return $this->redirect($this->generateUrl('listusers'));
    }
}
