<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Core\Domain\Comment;
use App\Core\Port\CommentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {
    }

    public function save(Comment $comment): void
    {
        $this->em->persist($comment);
        $this->em->flush();
    }
}
