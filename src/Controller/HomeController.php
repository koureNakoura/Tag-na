<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    

    private $twig;
    //persist data in db
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    } 
    
    #[Route('/', name: 'homepage')]
    public function index(ArticleRepository $articleRepo,Request $request): Response
    {
        $articles = $articleRepo->findBy([], ['created_at' => 'DESC']);

      

        return new Response($this->twig->render('home/index.html.twig', [
            
            'articles' => $articles,
        ]));

      }

       
}
