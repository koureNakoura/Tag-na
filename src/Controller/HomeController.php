<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\MemberRepository;
use App\Repository\ProjectRepository;
use App\Repository\TenderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    

    private $twig;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    } 
    
    #[Route('/', name: 'homepage')]
    public function index(ArticleRepository $articleRepo, MemberRepository $memberRepo, ProjectRepository $projectRepo, TenderRepository $tenderRepo): Response
    {
        $articles = $articleRepo->findBy([], ['created_at' => 'DESC']);
        $members = $memberRepo->findAll();
        $projects = $projectRepo->findBy([], ['created_at' => 'DESC']);
        $tenders = $tenderRepo->findBy([], ['createdAt' => 'DESC']);
        return new Response($this->twig->render('home/index.html.twig', [
            
            'articles' => $articles,
            'members' => $members,
            'projects' => $projects,
            'tenders' => $tenders,

        ]));

      }

       
}
