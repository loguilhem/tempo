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
            'users' => $manager->getRepository(User::class)->findAll()
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $times = $manager->getRepository(Time::class)->getTimes(
                $form['project']->getData(),
                $form['task']->getData(),
                $form['user']->getData(),
                $form['startTime']->getData(),
                $form['endTime']->getData()
            );

            return $this->render('analytics/results.html.twig', [
                'times' => $times
            ]);
        }

        return $this->render('analytics/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
