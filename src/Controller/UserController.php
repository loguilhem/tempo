<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route(path="/list-users", name="listusers", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listUsersAction(EntityManagerInterface $entityManager)
    {
        return $this->render('lists/users.html.twig', [
            'users' => $entityManager->getRepository(User::class)->findAll()
        ]);
    }
    /**
     * @Route(path="/promoteuser/{id}", name="promoteuser", methods={"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function promoteUserAction($id, EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $currentRole = $user->getHigherRole();
        $newRole = $user->upRole();
        $user->removeRole($currentRole);
        $user->addRole($newRole);

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
    public function demoteUserAction($id, EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $currentRole = $user->getHigherRole();
        $newRole = $user->downRole();
        $user->removeRole($currentRole);
        $user->addRole($newRole);

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
    public function activateUserAction($id, EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
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


        return $this->redirectToRoute('listusers');
    }
}
