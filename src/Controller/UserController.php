<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route(path="/", name="user_list", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function listUsers(EntityManagerInterface $entityManager)
    {
        return $this->render('page/user/list.html.twig', [
            'users' => $entityManager->getRepository(User::class)->findTeamMembersExceptMe($this->getUser())
        ]);
    }
    /**
     * @Route(path="/{id}/{action}", name="promote_demote_user", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function promoteUserAction(
        User $user,
        string $action,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $this->denyAccessUnlessGranted('setRole', $user);

        $roles = $user->getLowerAndHigherRole();

        if ($action === 'promote' && $roles['actual'] !== User::ROLE_ADMIN) {
            $user->removeRole($roles['actual']);
            $user->addRole($roles['next']);

            $entityManager->flush();

            $flashBag->add('success', $translator->trans('User is '. $roles['next']));
        } elseif ($action === 'demote' && $roles['actual'] !== User::ROLE_USER) {
            $user->removeRole($roles['actual']);
            $user->addRole($roles['previous']);
            
            $entityManager->flush();

            $flashBag->add('success', $translator->trans('User is '. $roles['previous']));
        } else {
            $flashBag->add('success', $translator->trans('User role cannot be modified'));
        }

        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route(path="{id}/activate", name="activateuser", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function activateUser(
        User $user,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $locked = $user->isEnabled();

        if($locked == 0) {
            $user->setEnabled(true);
            $flashBag->add('success', $translator->trans('User is enabled'));
        } else {
            $user->setEnabled(false);
            $flashBag->add('success', $translator->trans('User is disabled'));
        }
        $entityManager->flush();

        return $this->redirectToRoute('user_list');
    }
}
