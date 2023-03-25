<?php

namespace App\Core\Domain;

use App\Lib\Uuid;
use ArrayAccess;
use Countable;

class Article
{
    /** @var list<Comment>|(ArrayAccess<int, Comment>&Countable&iterable<int, Comment>)  */
    private $comments = [];

    public function __construct(
        private string $id,
        private string $title,
        private string $text,
    )
    {
        $this->id = Uuid::new();
    }

    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return iterable<Comment>
     */
    public function getComments(): iterable
    {
        return $this->comments;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }
}
