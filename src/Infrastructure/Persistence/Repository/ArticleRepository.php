<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Core\Domain\Article;
use App\Core\Port\ArticleRepositoryInterafce;
use Doctrine\ORM\EntityManagerInterface;

class ArticleRepository implements ArticleRepositoryInterafce
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {
    }

    public function getArticleDetail(Article $article): ?Article
    {
        return $this->em->createQueryBuilder()
            ->select(['article', 'comments', 'responsesComment'])
            ->from(Article::class, 'article')
            ->leftJoin('article.comments', 'comments')
            ->leftJoin('comments.comments', 'responsesComment')
            ->where('article = :article')
            ->setParameter('article', $article)
            ->getQuery()->getOneOrNullResult()
            ;
    }

    /**
     * @return list<Article>
     */
    public function getAll(): array
    {
        return $this->em->createQueryBuilder()
            ->select(['article', 'comments', 'responsesComment'])
            ->from(Article::class, 'article')
            ->leftJoin('article.comments', 'comments')
            ->leftJoin('comments.comments', 'responsesComment')
            ->getQuery()->getResult()
            ;
    }
}
