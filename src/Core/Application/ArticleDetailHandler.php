<?php

namespace App\Core\Application;

use App\Core\Domain\Article;
use App\Core\Port\ArticleRepositoryInterafce;

class ArticleDetailHandler
{
    public function __construct(
        private ArticleRepositoryInterafce $repository,
    )
    {
    }

    public function __invoke(Article $article): ?Article
    {
        return $this->repository->getArticleDetail($article);
    }
}
