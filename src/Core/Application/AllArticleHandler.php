<?php

namespace App\Core\Application;

use App\Core\Domain\Article;
use App\Core\Port\ArticleRepositoryInterafce;

class AllArticleHandler
{
    public function __construct(
        private ArticleRepositoryInterafce $repository,
    )
    {
    }

    /**
     * @return list<Article>
     */
    public function __invoke(): iterable
    {
        return $this->repository->getAll();
    }
}
