<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @Route(path="/list", name="list_projects", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function listProjects(EntityManagerInterface $entityManager, Request $request, SessionInterface $session)
    {
        $this->denyAccessUnlessGranted('view', $this->companySession);

        return $this->render('page/project/list.html.twig', [
            'projects' => $entityManager->getRepository(Project::class)->findBy([
                'company' => $session->get('_company')
            ]),
            'projectToDelete' => $request->request->get('projectToDelete')
        ]);
    }

    /**
     * @Route(path="/add", name="addproject", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function addProject(
        Request $request,
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $this->denyAccessUnlessGranted('add', $this->companySession);

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $project->setCompany($this->companySession);

            $this->em->persist($project);
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Project added'));
            return $this->redirectToRoute('list_projects');
        }

        return $this->render('page/project/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    

    /**
     * @Route(path="/{id}/edit/", name="edit_project", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     * @ParamConverter("project", class="App\Entity\Project")
     */
    public function edit(Project $project, Request $request, FlashBagInterface $flashBag, TranslatorInterface $translator)
    {
        $this->denyAccessUnlessGranted('edit', $project);

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Project edited'));

            return $this->redirectToRoute('list_projects');
        }
        
        return $this->render('page/project/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/delete", name="delete_project", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, TranslatorInterface $translator, FlashBagInterface $flashBag)
    {
        $project = $this->em->getRepository(Project::class)->find($request->request->get('id'));
        $this->denyAccessUnlessGranted('delete', $project);

        if (!count($project->getTimes()) > 0) {
            $this->em->remove($project);
            $this->em->flush();
            $flashBag->add('success', $translator->trans('Project deleted.'));
        } else {
            $flashBag->add('error', $translator->trans('Cannot delete a project which has times recorded.'));
        }

        return $this->redirectToRoute('list_projects');
    }
}
