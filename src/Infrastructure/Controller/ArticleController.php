<?php

namespace App\Infrastructure\Controller;

use App\Core\Application\ArticleDetailHandler;
use App\Core\Application\CreateCommentHandler;
use App\Core\Domain\Article;
use App\Core\Domain\Comment;
use App\Core\Dto\CommentDto;
use App\Infrastructure\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{

    public function __construct(
        private CreateCommentHandler $createCommentHandler,
        private ArticleDetailHandler $articleDetailHandler,
    )
    {
    }

    #[Route('/article/{id}', name: 'detail-article', methods: ['GET'])]
    public function article(Article $article): Response
    {
        $form = $this->createForm(CommentType::class);
        $article = ($this->articleDetailHandler)($article);
        return $this->render('article.html.twig',
            [
                'article' => $article,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route('/article/{id}/comment', name: 'add-comment-article', methods: ['POST'])]
    public function addCommentOnArticle(Article $article, Request $request): Response
    {
        $commentDto = new CommentDto(article: $article);
        $form = $this->createForm(CommentType::class, $commentDto);

        $form->handleRequest($request);
        if ($form->isValid()) {
            ($this->createCommentHandler)($commentDto);
        }

        return $this->redirectToRoute('detail-article', ['id' => $article->getId()]);
    }

    #[Route('comment/{id}/comment', name: 'add-comment-comment', methods: ['POST'])]
    public function addCommentOnComment(Comment $comment, Request $request): Response
    {
        $commentDto = new CommentDto(comment: $comment);
        $commentDto->text =  $request->request->get('text');
        $newComment =  ($this->createCommentHandler)($commentDto);
        $article = ($this->articleDetailHandler)($comment->getArticle());

        return $this->redirectToRoute('detail-article', ['id' => $comment->getArticle()->getId()]);
    }

}
