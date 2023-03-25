<?php

namespace App\Infrastructure\Api;

use App\Core\Application\CreateCommentHandler;
use App\Core\Domain\Article;
use App\Core\Domain\Comment;
use App\Core\Dto\CommentDto;
use App\Core\Dto\CommentOutputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CommentController extends AbstractController
{
    public function __construct(
        private CreateCommentHandler $createCommentHandler,
    )
    {
    }

    #[Route('/article/{id}/comment', name: 'api-add-comment-article', methods: ['POST'])]
    public function addCommentOnArticle(Article $article, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $commentDto = new CommentDto(text: $data['text'], article: $article);
        $comment = ($this->createCommentHandler)($commentDto);

        return new JsonResponse(CommentOutputDto::toDto($comment), Response::HTTP_CREATED);
    }

    #[Route('/comment/{id}/comment', name: 'api-add-comment-comment', methods: ['POST'])]
    public function addCommentOnComment(Comment $comment, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $commentDto = new CommentDto(text: $data['text'], comment: $comment);
        $newComment = ($this->createCommentHandler)($commentDto);

        return new JsonResponse(CommentOutputDto::toDto($newComment), Response::HTTP_CREATED);
    }
}
