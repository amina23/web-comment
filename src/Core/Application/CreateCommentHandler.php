<?php

namespace App\Core\Application;

use App\Core\Domain\Comment;
use App\Core\Dto\CommentDto;
use App\Core\Port\CommentRepositoryInterface;
use App\Lib\Uuid;

class CreateCommentHandler
{
    public function __construct(
        private CommentRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(CommentDto $commentDto): Comment
    {
        $comment = new Comment(Uuid::new(),text: $commentDto->text, article: $commentDto->article, comment: $commentDto->comment);
        $this->repository->save($comment);

        return $comment;
    }
}
