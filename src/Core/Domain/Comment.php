<?php

namespace App\Core\Domain;

use App\Lib\Uuid;
use ArrayAccess;
use Countable;

class Comment
{
    /** @var list<Comment>|(ArrayAccess<int, Comment>&Countable&iterable<int, Comment>)  */
    private $comments = [];

    public function __construct(
        private string $id,
        private string $text,
        private ?Article $article = null,
        private ?Comment $comment = null,
    )
    {
        if ($this->article === null && $this->comment === null) {
            throw new \DomainException('Un commentaire doit être lié à un article ou un commentaire');
        }
        $this->id = Uuid::new();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    /**
     * list<Comment>|(ArrayAccess<int, Comment>&Countable&iterable<int, Comment>)
     */
    public function getComments(): iterable
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        $this->comment[] = $comment;
    }
}
