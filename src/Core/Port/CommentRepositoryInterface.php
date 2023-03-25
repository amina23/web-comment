<?php

namespace App\Core\Port;

use App\Core\Domain\Comment;

interface CommentRepositoryInterface
{
    public function save(Comment $comment);

}
