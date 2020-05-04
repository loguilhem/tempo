<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class ProjectController
 * @package App\Controller
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route(path="list", name="list_projects", methods={"GET", "POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function listProjects(EntityManagerInterface $entityManager, Request $request)
    {
        return $this->render('project/list.html.twig', [
            'projects' => $entityManager->getRepository(Project::class)->findBy([
                'company' => $this->getUser()->getCompany()
            ]),
            'projectToDelete' => $request->request->get('projectToDelete')
        ]);
    }

    /**
     * @Route(path="/add", name="addproject", methods={"GET", "POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function addProject(
        Request $request,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator,
        EntityManagerInterface $entityManager
    )
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $project->setCompany($this->getUser()->getCompany());

            $entityManager->persist($project);
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Project added'));
            return $this->redirectToRoute('list_projects');
        }

        return $this->render('project/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    

    /**
     * @Route(path="/{id}/edit/", name="edit_project", methods={"GET", "POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     * @ParamConverter("project", class="App\Entity\Project")
     */
    public function edit(Project $project, Request $request, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, TranslatorInterface $translator)
    {
        $this->denyAccessUnlessGranted('edit', $project);

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $flashBag->add('success', $translator->trans('Project edited'));

            return $this->redirectToRoute('list_projects');
        }
        
        return $this->render('project/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/delete", name="delete_project", methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function delete(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $project = $entityManager->getRepository(Project::class)->find($request->request->get('id'));
        $this->denyAccessUnlessGranted('delete', $project);

        $entityManager->remove($project);
        $entityManager->flush();
        $flashBag->add('success', $translator->trans('Project deleted.'));

        return $this->redirectToRoute('list_projects');
    }
}
