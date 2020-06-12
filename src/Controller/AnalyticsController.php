<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use App\Entity\User;
use App\Form\AnalyticsType;
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
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AnalyticsType::class, null, [
            'projects' => $manager->getRepository(Project::class)->findAll(),
            'tasks' => $manager->getRepository(Task::class)->findAll(),
            'users' => $manager->getRepository(User::class)->findAll(),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projectsData = $form['project']->getData();
            $tasksData = $form['task']->getData();
            $usersData = $form['user']->getData();

            // We get all times according to data form
            $times = $manager->getRepository(Time::class)->getTimes($projectsData, $tasksData, $usersData, $form['startTime']->getData(), $form['endTime']->getData());

            // the total of hours for each projects passed in data form
            $projects = [];
            /** @var Project $project */
            foreach ($projectsData as $project) {
                $projects[$project->getId()]['name'] = $project->getName();
                /** @var Task $task */
                foreach ($tasksData as $task) {
                    $projects[$project->getId()]['tasks'][$task->getId()]['name'] = $task->getName();
                    $projects[$project->getId()]['tasks'][$task->getId()]['total'] = 0;
                    /** @var Time $time */
                    foreach ($times as $time) {
                        if ($project === $time->getProject() && $task === $time->getTask()) {
                            $diff = $time->getEndTime()->diff($time->getStartTime());
                            $hours1 = $hours2 = $hours3 = 0;
                            if ($diff->format('%a') > 0) {
                                $hours1 = $diff->format('%a') * 24;
                            }
                            if ($diff->format('%h') > 0) {
                                $hours2 = $diff->format('%h');
                            }
                            if ($diff->format('%m') > 0) {
                                $hours3 = round($diff->format('%m') / 60, 2);
                            }

                            $time->diff = $hours1 + $hours2 + $hours3;
                            $projects[$project->getId()]['tasks'][$task->getId()]['total'] = $time->diff + $projects[$project->getId()]['tasks'][$task->getId()]['total'];
                        }
                    }
                }
            }

            // the total of hours for each projects passed in data form
            $tasks = [];
            /** @var Task $task */
            foreach ($tasksData as $task) {
                $tasks[$task->getId()]['name'] = $task->getName();
                /** @var Project $project */
                foreach ($projectsData as $project) {
                    $tasks[$task->getId()]['projects'][$project->getId()]['name'] = $project->getName();
                    $tasks[$task->getId()]['projects'][$project->getId()]['total'] = 0;
                    /** @var Time $time */
                    foreach ($times as $time) {
                        if ($project === $time->getProject() && $task === $time->getTask()) {
                            $diff = $time->getEndTime()->diff($time->getStartTime());
                            $hours1 = $hours2 = $hours3 = 0;
                            if ($diff->format('%a') > 0) {
                                $hours1 = $diff->format('%a') * 24;
                            }
                            if ($diff->format('%h') > 0) {
                                $hours2 = $diff->format('%h');
                            }
                            if ($diff->format('%m') > 0) {
                                $hours3 = round($diff->format('%m') / 60, 2);
                            }

                            $time->diff = $hours1 + $hours2 + $hours3;
                            $tasks[$task->getId()]['projects'][$project->getId()]['total'] = $time->diff + $tasks[$task->getId()]['projects'][$project->getId()]['total'];
                        }
                    }
                }
                dump($tasks);
            }

            return $this->render('analytics/results.html.twig', [
                'times' => $times,
                'projects' => $projects,
                'tasks' => $tasks
            ]);
        }

        return $this->render('analytics/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
