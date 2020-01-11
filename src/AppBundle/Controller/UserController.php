<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route(path="/listusers", name="listusers", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listUsersAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('user/listUsers.html.twig', array(
            'listUsers' => $users
        ));
    }
    /**
     * @Route(path="/promoteuser/{id}", name="promoteuser", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function promoteUserAction($id, EntityManager $entityManager, UserManagerInterface $userManager, FlashBagInterface $flashBag)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $currentRole = $user->getHigherRole();
        $newRole = $user->upRole();
        $user->removeRole($currentRole);
        $user->addRole($newRole);
        $userManager->updateUser($user);

        if($currentRole == $newRole) {
            $flashBag->add('success', 'Utilisateur a déjà tous les droits');
        } else {
            $flashBag->add('success', 'Utilisateur promu');
        }

        Return $this->redirectToRoute('listusers');
    }

    /**
     * @Route(path="/demoteuser/{id}", name="demoteuser", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function demoteUserAction($id, EntityManager $entityManager, UserManagerInterface $userManager, FlashBagInterface $flashBag)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $currentRole = $user->getHigherRole();
        $newRole = $user->downRole();
        $user->removeRole($currentRole);
        $user->addRole($newRole);
        $userManager->updateUser($user);

        if($currentRole == $newRole) {
            $flashBag->add('success', 'Utilisateur est déjà au minimum de droits');
        } else {
            $flashBag->add('success', 'Utilisateur destitué');
        }

        Return $this->redirectToRoute('listusers');
    }

    /**
     * @Route(path="/activateuser/{id}", name="activateuser", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function activateUserAction($id, EntityManager $entityManager, FlashBagInterface $flashBag, UserManagerInterface $userManager)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $locked = $user->isEnabled();

        if($locked == 0) {
            $user->setEnabled(1);
            $flashBag->add('success', 'L\'utilisateur est actif');
        } else {
            $user->setEnabled(0);
            $flashBag->add('success', 'L\'utilisateur est bloqué');
        }

        $userManager->updateUser($user);

        return $this->redirectToRoute('listusers');
    }
}
