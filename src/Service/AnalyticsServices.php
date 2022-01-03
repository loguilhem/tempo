<?php


namespace App\Service;


use App\Entity\Company;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Time;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class AnalyticsServices
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Company
     */
    private $company;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->company = $em->getRepository(Company::class)->find($session->get('_company'));
    }

    public function analyzePerProjects(array $projects, array $tasks, array $users, array $times): array
    {
        $stats = [];
        $projects = $this->getProjects($projects);
        $tasks = $this->getTasks($tasks);
        $users = $this->getUsers($users);

        /** @var Project $project */
        foreach ($projects as $project) {
            $stats[$project->getId()]['name'] = $project->getName();
            $stats[$project->getId()]['id'] = $project->getId();

            // Per projects and tasks
            /** @var Task $task */
            foreach ($tasks as $task) {
                $stats[$project->getId()]['tasks'][$task->getId()]['name'] = $task->getName();
                $stats[$project->getId()]['tasks'][$task->getId()]['total'] = 0;
                /** @var Time $time */
                foreach ($times as $time) {
                    if ($project === $time->getProject() && $task === $time->getTask()) {
                        $stats[$project->getId()]['tasks'][$task->getId()]['total'] = $this->timeToHours($time) + $stats[$project->getId()]['tasks'][$task->getId()]['total'];
                    }
                }

                $stats = $this->cleanSubStats($stats, $project->getId(), 'tasks', $task->getId());
            }

            // Per projects and users
            /** @var User $user */
            foreach ($users as $user) {
                $stats[$project->getId()]['users'][$user->getId()]['username'] = $user->getUsername();
                $stats[$project->getId()]['users'][$user->getId()]['total'] = 0;
                foreach ($times as $time) {
                    if ($project === $time->getProject() && $user === $time->getUser()) {
                        $stats[$project->getId()]['users'][$user->getId()]['total'] = $this->timeToHours($time) + $stats[$project->getId()]['users'][$user->getId()]['total'];
                    }
                }

                $stats = $this->cleanSubStats($stats, $project->getId(), 'users', $user->getId());
            }

            $stats = $this->cleanStats($stats, $project->getId(), 'tasks');
        }

        return $stats;

    }

    public function analyzePerTasks(array $projects, array $tasks, array $users, array $times): array
    {
        $stats = [];
        $projects = $this->getProjects($projects);
        $tasks = $this->getTasks($tasks);
        $users = $this->getUsers($users);

        /** @var Task $task */
        foreach ($tasks as $task) {
            $stats[$task->getId()]['name'] = $task->getName();
            $stats[$task->getId()]['id'] = $task->getId();

            // Per tasks and projects
            /** @var Project $project */
            foreach ($projects as $project) {
                $stats[$task->getId()]['projects'][$project->getId()]['name'] = $project->getName();
                $stats[$task->getId()]['projects'][$project->getId()]['total'] = 0;
                /** @var Time $time */
                foreach ($times as $time) {
                    if ($project === $time->getProject() && $task === $time->getTask()) {
                        $stats[$task->getId()]['projects'][$project->getId()]['total'] = $this->timeToHours($time) + $stats[$task->getId()]['projects'][$project->getId()]['total'];
                    }
                }
                $stats = $this->cleanSubStats($stats, $task->getId(), 'projects', $project->getId());
            }

            /** @var User $user */
            foreach ($users as $user) {
                $stats[$task->getId()]['users'][$user->getId()]['username'] = $user->getUsername();
                $stats[$task->getId()]['users'][$user->getId()]['total'] = 0;
                foreach ($times as $time) {
                    if ($task === $time->getTask() && $user === $time->getUser()) {
                        $stats[$task->getId()]['users'][$user->getId()]['total'] = $this->timeToHours($time) + $stats[$task->getId()]['users'][$user->getId()]['total'];
                    }
                }

                $stats = $this->cleanSubStats($stats, $task->getId(), 'users', $user->getId());
            }

            $stats = $this->cleanStats($stats, $task->getId(), 'projects');
        }

        return $stats;
    }

    public function analyzePerUsers(array $projects, array $tasks, array $users, array $times): array
    {
        $stats = [];
        $projects = $this->getProjects($projects);
        $tasks = $this->getTasks($tasks);
        $users = $this->getUsers($users);

        /** @var User $user */
        foreach ($users as $user) {
            $stats[$user->getId()]['username'] = $user->getUsername();
            $stats[$user->getId()]['id'] = $user->getId();

            // Per users and projects
            /** @var Project $project */
            foreach ($projects as $project) {
                $stats[$user->getId()]['projects'][$project->getId()]['name'] = $project->getName();
                $stats[$user->getId()]['projects'][$project->getId()]['total'] = 0;
                /** @var Time $time */
                foreach ($times as $time) {
                    if ($project === $time->getProject() && $user === $time->getUser()) {
                        $stats[$user->getId()]['projects'][$project->getId()]['total'] = $this->timeToHours($time) + $stats[$user->getId()]['projects'][$project->getId()]['total'];
                    }
                }

                $stats = $this->cleanSubStats($stats, $user->getId(), 'projects', $project->getId());
            }

            /** @var Task $task */
            foreach ($tasks as $task) {
                $stats[$user->getId()]['tasks'][$task->getId()]['name'] = $task->getName();
                $stats[$user->getId()]['tasks'][$task->getId()]['total'] = 0;
                foreach ($times as $time) {
                    if ($task === $time->getTask() && $user === $time->getUser()) {
                        $stats[$user->getId()]['tasks'][$task->getId()]['total'] = $this->timeToHours($time) + $stats[$user->getId()]['tasks'][$task->getId()]['total'];
                    }
                }

                $stats = $this->cleanSubStats($stats, $user->getId(), 'tasks', $task->getId());
            }

            $stats = $this->cleanStats($stats, $user->getId(), 'projects');
        }

        return $stats;
    }

    public function exportTimesToCSV(array $times)
    {
        $rows = [];
        /** @var Time $time */
        foreach ($times as $time) {
            $data = [
                $time->getProject()->getName(),
                $time->getTask()->getName(),
                $time->getUser()->getEmail() . ' [' . $time->getUser()->getUsername() . ']',
                $time->getStartTime()->format('d/m/Y H:i'),
                $time->getEndTime()->format('d/m/Y H:i')
            ];

            $rows[] = implode(',', $data);
        }

        return implode("\n", $rows);
    }

    private function timeToHours(Time $time): float
    {
        $diff = $time->getEndTime()->getTimestamp() - $time->getStartTime()->getTimestamp();

        return $diff / ( 60 * 60 );
    }

    private function getProjects(array $projects) : array
    {
        if (count($projects) === 0) {
            $projects = $this->em->getRepository(Project::class)->findBy([
                'company' => $this->company
            ]);
        }

        return $projects;
    }

    private function getTasks(array $tasks) : array
    {
        if (count($tasks) === 0) {
            $tasks = $this->em->getRepository(Task::class)->findBy([
                'company' => $this->company
            ]);
        }

        return $tasks;
    }

    private function getUsers(array $users) : array
    {
        if (count($users) === 0) {
            $users = $this->em->getRepository(User::class)->findByCompany(
                $this->company
            );
        }

        return $users;
    }

    private function cleanStats($stats, int $perId, string $category): array
    {
        if (0 === count($stats[$perId][$category])) {
                unset($stats[$perId]);
        }

        return $stats;
    }

    private function cleanSubStats(array $stats, int $perId, string $subName, int $subId): array
    {
        // Delete tasks with no times
        if (0 === $stats[$perId][$subName][$subId]['total']) {
            unset($stats[$perId][$subName][$subId]);
        }

        return $stats;
    }

}