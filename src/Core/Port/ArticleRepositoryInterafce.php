<?php

namespace App\Core\Port;

use App\Core\Domain\Article;

interface ArticleRepositoryInterafce
{
    public function getArticleDetail(Article $article);

    public function getAll(): array;
}
