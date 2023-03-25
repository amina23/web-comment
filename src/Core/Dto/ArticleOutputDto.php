<?php

namespace App\Core\Dto;

use App\Core\Domain\Article;
use App\Core\Domain\Comment;
use App\Lib\Tools;
use function App\Lib\iterable_to_array;

class ArticleOutputDto
{
    public string $articleId;
    public array $comments;


    private function __construct(
    )
    {
    }

    public static function toDto(Article $article): self
    {
        $dto = new self();

        $dto->articleId = $article->getId();
        $dto->comments =  array_map(
            function (Comment $comment) {
                return CommentOutputDto::toDto($comment);
                },
        Tools::iterable_to_array($article->getComments()),
        );

        return $dto;
    }

    /**
     * @param list<Article> $articles
     *
     * @return array<mixed>
     */
    public static function getList(iterable $articles): array
    {
        return
            array_map(function(Article $article) {
            return ArticleOutputDto::toDto($article);
        },
        Tools::iterable_to_array($articles),
        );
    }
}
