<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use App\Entity\User;
use App\Form\AnalyticsType;
use App\Service\AnalyticsServices;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AnalyticsController extends AbstractController
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
     * @Route(path="/analytics", name="analytics", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, AnalyticsServices $analyticsServices): Response
    {
        $company = $this->companySession;
        $form = $this->createForm(AnalyticsType::class, null, [
            'projects' => $this->em->getRepository(Project::class)->findBy(['company' => $company]),
            'tasks' => $this->em->getRepository(Task::class)->findBy(['company' => $company]),
            'users' => $this->em->getRepository(User::class)->findByCompany($company),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projectsData = $form['project']->getData();
            $tasksData = $form['task']->getData();

            $usersData = isset($form['user']) ? $form['user']->getData() : [$this->getUser()];

            // We get all times according to data form
            $times = $this->em->getRepository(Time::class)->getTimes($company, $projectsData, $tasksData, $usersData, $form['startTime']->getData(), $form['endTime']->getData());

            return $this->render('page/analytics/results.html.twig', [
                'times' => $times,
                'projects' => $analyticsServices->analyzePerProjects($projectsData, $tasksData, $usersData, $times),
                'tasks' => $analyticsServices->analyzePerTasks($projectsData, $tasksData, $usersData, $times),
                'users' => $analyticsServices->analyzePerUsers($projectsData, $tasksData, $usersData, $times)
            ]);
        }

        return $this->render('page/analytics/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
