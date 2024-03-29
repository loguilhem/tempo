<?php

namespace App\Controller;

use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
    public function listUsers(EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        return $this->render('page/user/list.html.twig', [
            'users' => $entityManager->getRepository(User::class)->findTeamMembersExceptMe(
                $this->getUser(),
                $session->get('_company')
            )
        ]);
    }

    /**
     * @Route(path="/my-profile", name="profile", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function profile()
    {
        return $this->render('page/user/profile.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route(path="/my-profile/edit", name="profile_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function editProfile(
        EntityManagerInterface $em,
        Request $request
    ): Response
    {
        $user = $this->getUser();
        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();

            return $this->render('page/user/profile.html.twig', [
                'user' => $user
            ]);
        }

        return $this->render('page/user/profile-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(path="/my-profile/password/edit", name="profile_password_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function editPassword(
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $em,
        Request $request
    ): Response
    {
        $user = $this->getUser();
        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $user
                ->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                )
            ;
            $em->flush();

            return $this->render('page/user/profile.html.twig', [
                'user' => $user
            ]);
        }

        return $this->render('page/user/profile-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(path="/roles/{id}/{action}", name="promote_demote_user", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function promoteUserAction(
        User $user,
        string $action,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    ): RedirectResponse
    {
        $this->denyAccessUnlessGranted('edit', $user);

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
    ): RedirectResponse
    {
        $this->denyAccessUnlessGranted('edit', $user);

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
