<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comment')]
final class CommentController extends AbstractController
{
    #[Route(name: 'app_comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('pages/blog/show.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    // Créer un nouveau commentaire
    #[Route('/{id}/create', name: 'app_comment_create', methods: ['POST'])]
    public function createComment(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPost($post);
            $comment->setAuthor($this->getUser());

            if (!$comment->isLegitComment()) {
                $this->addFlash('warning', 'Votre commentaire semble contenir des caractères invalides.');
            }

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_blog_show', ['id' => $post->getId()]);
        }

        return $this->redirectToRoute('app_blog_show', [
            'id' => $post->getId(),
        ]);
    }

    // Éditer un commentaire existant
    #[Route('/{id}/edit', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    public function editComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_blog_show', ['id' => $comment->getPost()->getId()]);
        }

        // return $this->render('blog/show.html.twig', [
        //     'comment' => $comment,
        //     'form' => $form->createView(),
        // ]);

         // Gestion des erreurs de validation
        return $this->redirectToRoute('app_blog_show', ['id' => $comment->getPost()->getId()]);
    }

    // Supprimer un commentaire
    #[Route('/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function deleteComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_blog_show', ['id' => $comment->getPost()->getId()]);
    }
}

