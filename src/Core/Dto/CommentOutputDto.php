<?php

namespace App\Core\Dto;

use App\Core\Domain\Comment;
use App\Lib\Tools;

class CommentOutputDto
{
    public string $id;
    public string $text;
    public ?string $commentId;
    public ?string $articleId;
    public array $responses = [];

    private function __construct()
    {
    }

    public static function toDto(Comment $comment): self
    {
        $dto = new self();

        $dto->id = $comment->getId();
        $dto->text = $comment->getText();
        $dto->commentId = $comment->getComment()?->getId();
        $dto->articleId = $comment->getArticle()?->getId();
        $dto->responses =  array_map(
            function (Comment $comment) {
                return [
                    'text' => $comment->getText(),
                    'id' => $comment->getId(),
                ];
            },
            Tools::iterable_to_array($comment->getComments()),
        );

        return $dto;
    }
}
