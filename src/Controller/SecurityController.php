<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use App\Service\CompanyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route(name="login", path="/login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('page/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/reset_password_ask", name="app_ask_reset_password")
     */
    public function askResetPassword()
    {
        return $this->render('page/security/ask_reset_password.html.twig');
    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password", methods={"POST"})
     */
    public function resetForgottenPassword(EntityManagerInterface $entityManager, Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response
    {
        $email = $request->request->get('email');
        /** @var User $user */
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if ($user === null) {
            $this->addFlash('error', 'Email unknown');
            return $this->redirectToRoute('index');
        }
        $token = $tokenGenerator->generateToken();

        try {
            $user->setConfirmationToken($token);
            $entityManager->flush();
        } catch (\Exception $e) {
            $this->addFlash('warning', $e->getMessage());
            return $this->redirectToRoute('index');
        }

        $url = $this->generateUrl('app_reset_password', [
            'token' => $token
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $message = (new \Swift_Message('Forgot Password'))
            ->setFrom('noreply@yourmailhost.com')
            ->setTo($user->getEmail())
            ->setBody("use link below to reset password : " .
                $url, 'text/html');
        $mailer->send($message);

        $this->addFlash('notice', 'Email sent');

        return $this->redirectToRoute('index');
    }

    /**
     * @Route(path="/reset_password/{token}", name="app_reset_password", methods={"POST", "GET"})
     */
    public function resetPassword(EntityManagerInterface $entityManager, Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            /** @var User $user */
            $user = $entityManager->getRepository(User::class)->findOneBy([
                'confirmationToken' => $token
            ]);
            if ($user === null) {
                $this->addFlash('error', 'unknown token');
                return $this->redirectToRoute('index');
            }

            $user->setConfirmationToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            $this->addFlash('succes', 'Password updated');

            return $this->redirectToRoute('index');
        }

        return $this->render('page/security/reset_password.html.twig', [
            'token' => $token
        ]);
    }


    /**
     * @Route(name="register", path="/register", methods={"GET", "POST"})
     * this is the first step of registration
     */
    public function register(
        EntityManagerInterface $em,
        AuthenticationUtils $authenticationUtils,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        LoginFormAuthenticator $authenticator,
        CompanyService $companyService,
        SessionInterface $session
    ): Response
    {
        $user = new User();
        $registration = $request->request->get('registration');
        $role = null === $registration ? 'ROLE_USER' : $registration['accountType'];
        // if you want to disable the registration of a new company, pass ALLOW_ADD_COMPANY to 0 in .env
        $form = $this->createForm(RegistrationType::class, $user, [
            'role' => $role,
            'addCompany' => (bool) $this->getParameter('allow_add_company'),
        ]);

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
                ->addRole($role)
                ->setEnabled(true)
            ;

            if ($form->has('Company')) {
                /** @var Company $newCompany */
                $company = $form->get('Company')->getData();
                $company->addMember($user);
                $em->persist($company);
            }

            if ('ROLE_USER' === $role) {
                $tokenField = $form->get('token');
                if (!$tokenField->getData()) {
                    $tokenField->addError(new FormError('Token cannot be blank'));

                    return $this->render('page/security/register.html.twig', [
                        'registrationForm' => $form->createView(),
                        'error' => $authenticationUtils->getLastAuthenticationError(),
                        'last_username' => $authenticationUtils->getLastUsername()
                    ]);
                }

                $company = $em->getRepository(Company::class)->findOneBy([
                    'token' => $tokenField->getData()
                ]);

                if (!$company) {
                    $tokenField->addError(new FormError('Token not available'));

                    return $this->render('page/security/register.html.twig', [
                        'registrationForm' => $form->createView(),
                        'error' => $authenticationUtils->getLastAuthenticationError(),
                        'last_username' => $authenticationUtils->getLastUsername()
                    ]);
                }
                $user->addCompany($company);
            }

            $em->persist($user);
            $em->flush();

            $companyService->setSession($request, $session, $company);

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('page/security/register.html.twig', [
            'registrationForm' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername()
        ]);
    }
}