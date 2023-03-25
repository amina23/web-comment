<?php

namespace App\Core\Dto;

use App\Core\Domain\Article;
use App\Core\Domain\Comment;

class CommentDto
{
    public function __construct(
        public ?string $text = null,
        public ?Article $article = null,
        public ?Comment $comment = null,
    ) {
        if($this->article === null && $this->comment === null)
        {
            throw new \DomainException("un commentaire doit être sur un article ou un commentaire");
        }
    }

}
