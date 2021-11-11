<?php

namespace App\Controller;

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
use Symfony\Component\Routing\Annotation\Route;

class AnalyticsController extends AbstractController
{
    /**
     * @Route(path="/analytics", name="analytics", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, EntityManagerInterface $manager, AnalyticsServices $analyticsServices)
    {
        $company = $this->getUser()->getCompanies();
        $form = $this->createForm(AnalyticsType::class, null, [
            'projects' => $manager->getRepository(Project::class)->findBy(['company' => $company]),
            'tasks' => $manager->getRepository(Task::class)->findBy(['company' => $company]),
            'users' => $manager->getRepository(User::class)->findBy(['company' => $company]),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projectsData = $form['project']->getData();
            $tasksData = $form['task']->getData();

            $usersData = isset($form['user']) ? $form['user']->getData() : [$this->getUser()];

            // We get all times according to data form
            $times = $manager->getRepository(Time::class)->getTimes($company, $projectsData, $tasksData, $usersData, $form['startTime']->getData(), $form['endTime']->getData());

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
