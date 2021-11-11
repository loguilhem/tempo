<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * TimeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TimeRepository extends EntityRepository
{
    public function getTimes(
        Company $company,
        array $projects = null,
        array $tasks = null,
        array $users = null,
        \DateTime $start = null,
        \DateTime $end = null
    )
    {
        $qb = $this->createQueryBuilder('time')
            ->join('time.user', 'u')
            ->join('time.project', 'project')
            ->join('project.company', 'c')
            ->join('time.task', 'task')
            ->andWhere('c.id = :company')
            ->setParameter('company', $company)
            ->addSelect('u')
            ->addSelect('project')
            ->addSelect('task')
        ;

        if ($projects) {
            $qb
                ->andWhere('time.project IN (:projects)')
                ->setParameter('projects', $projects)
            ;
        }

        if ($tasks) {
            $qb
                ->andWhere('time.task IN (:tasks)')
                ->setParameter('tasks', $tasks)
            ;
        }

        if ($users) {
            $qb
                ->andWhere('u IN (:users)')
                ->setParameter('users', $users)
            ;
        }

        if ($start && $end) {
            $qb->andWhere('time.startTime >= :start')
                ->andWhere('time.endTime <= :end')
                ->setParameter('start', $start)
                ->setParameter('end', $end)
            ;
        }

        $results = $qb->getQuery()->getResult();

        return $results;
    }
}
