<?php

/*This controller to form, modify et delete data from database*/
/*function to make stats et print results are on another controller*/

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class ProjectController extends Controller
{
    /**
     * @Route(path="list-projects", name="listprojects", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function listProjects(EntityManagerInterface $entityManager, Request $request)
    {
        return $this->render('lists/projects.html.twig', [
            'projects' => $entityManager->getRepository(Project::class)->findAll(),
            'projectToDelete' => $request->request->get('projectToDelete')
        ]);
    }

    /**
     * @Route(path="/add-project", name="addproject", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function addProject(Request $request, FlashBagInterface $flashBag, TranslatorInterface $translator, EntityManagerInterface $entityManager)
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $entityManager->persist($project);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('project.added'));
            return $this->redirectToRoute('listprojects');
        }

        return $this->render('form/project.html.twig', [
            'form' => $form->createView()
        ]);
    }
    

    /**
     * @Route(path="/{id}/project/", name="modproject", methods={"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modProject(Request $request, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TranslatorInterface $translator, $id)
    {
        $project = $entityManager->getRepository(Project::class)->find($id);
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Le projet a été correctement modifé.'));
            return $this->redirectToRoute('listprojects');
        }
        
        return $this->render('form/project.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/delete-project", name="delproject", methods={"POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function delProject(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $project = $entityManager->getRepository(Project::class)->find($request->request->get('id'));
        $entityManager->remove($project);
        $entityManager->flush();
        $flashBag->add('success', $translator->trans('Project deleted.'));

        return $this->redirectToRoute('listprojects');
    }
}
