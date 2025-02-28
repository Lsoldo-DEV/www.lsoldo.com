<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FAQRepository;
use App\Repository\PostRepository;
use App\Repository\SocialLinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/blog')]
class BlogController extends AbstractController
{

    #[Route('/', name: 'app_blog_index', methods: ['GET'])]
    public function index(Request $request, PostRepository $postRepository): Response
    {
        $locale = $request->get('_locale');
        $page = $request->query->getInt('page', 1);
        $posts = $postRepository->paginatePost($page, $locale);
        return $this->render('pages/blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'posts' => $posts,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_show', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function show(Request $request, Post $post, PostRepository $postRepository, EntityManagerInterface $entityManager, SocialLinkRepository $linkRepository, FAQRepository $faqRepository): Response
    {
        $locale = $request->getLocale();

        $description = null;
        foreach ($post->getDescription() as $desc) {
            if ($desc->getLang() === $locale) {
                $description = $desc;
                break;
            }
        }

        // Récupérer les 3 derniers posts en excluant le post actuel
        $latestPosts = $postRepository->findLatestPosts($locale, 2, $post->getId());

        $comments = [];
        foreach ($post->getComments() as $comment) {
            $comments[$comment->getId()] = $comment;
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
       
        return $this->render('pages/blog/show.html.twig', [
            'post' => $post,
            'latestPosts' => $latestPosts,
            'description' => $description,
            'commentForm' => $form->createView(),
            'comments' => $comments,
            'link' => $linkRepository->findOneBy([], ['id' => 'DESC']),
            'faqs' => $faqRepository->findAllOrderedByLang($locale)
        ]);
    }
 
}

   /*
   #[Route('/comment/{id}/edit', name: 'app_comment_edit', methods: ['GET', 'POST'])]
   public function editComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
   {
       $form = $this->createForm(CommentType::class, $comment);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->flush();

           return $this->redirectToRoute('app_blog_show', ['id' => $comment->getPost()->getId()]);
       }

       return $this->render('blog/edit_comment.html.twig', [
           'comment' => $comment,
           'form' => $form->createView(),
       ]);
   }

   #[Route('/comment/{id}', name: 'app_comment_delete', methods: ['POST'])]
   public function deleteComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
   {
       if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
           $entityManager->remove($comment);
           $entityManager->flush();
       }

       return $this->redirectToRoute('app_blog_show', ['id' => $comment->getPost()->getId()]);
   } 
       */