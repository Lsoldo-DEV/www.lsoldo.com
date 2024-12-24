<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\SocialLinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route( name: 'app_project_index', methods: ['GET'])]
    public function index(Request $request,ProjectRepository $projectRepository): Response
    {
       $projects= $projectRepository->findAllOrderedByLang( $request->get('_locale'));
        $tags = [];
        foreach ($projects as $project) {
            foreach ($project->getTags() as $tag) {
                if (!isset($tags[$tag->getId()])) {
                    $tags[$tag->getId()] = $tag;
                }
            }
        }



        return $this->render('pages/project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects,
            'tags' => array_values($tags),

        ]);
    }
    #[Route('/{id}', name: 'app_project_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Project $project,SocialLinkRepository $linkRepository): Response
    {
        $link = $linkRepository->findOneBy([], ['id' => 'DESC']);

        return $this->render('pages/project/show.html.twig', [
            'project' => $project,
            'link' => $link,
        ]);
    }
}
