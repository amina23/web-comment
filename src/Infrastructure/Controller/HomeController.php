<?php
namespace App\Infrastructure\Controller;

use App\Core\Domain\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {
         $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('index.html.twig',
            [
                'articles' => $articles,
            ]
        );
    }

    #[Route('/home-data', name: 'home-data')]
    public function data(): JsonResponse
    {
        $data = [
            'title' => 'Accueil',
            'text' => 'test'
        ];

        return $this->json($data);
    }

}
