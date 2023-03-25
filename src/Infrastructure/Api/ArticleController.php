<?php

namespace App\Infrastructure\Api;

use App\Core\Application\AllArticleHandler;
use App\Core\Application\ArticleDetailHandler;
use App\Core\Domain\Article;
use App\Core\Dto\ArticleOutputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{

    public function __construct(
        private ArticleDetailHandler $handler,
        private AllArticleHandler $allArticleHandler,
    )
    {
    }

    #[Route('/article/{id}', name: 'api-article-detail', methods: ['GET'])]
    public function articleDetail(Article $article): JsonResponse
    {
        $article = ($this->handler)($article);

        return new JsonResponse(ArticleOutputDto::toDto($article), Response::HTTP_OK);
    }

    #[Route('/article', name: 'api-article', methods: ['GET'])]
    public function allArticles(): JsonResponse
    {

        $articles = ($this->allArticleHandler)();
        return new JsonResponse(ArticleOutputDto::getList($articles), Response::HTTP_CREATED);
    }
}
