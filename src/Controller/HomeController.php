<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Article;
use App\Repository\MemberRepository;
use App\Repository\TenderRepository;
use App\Repository\ArticleRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(ArticleRepository $articleRepo, MemberRepository $memberRepo, 
    ProjectRepository $projectRepo, TenderRepository $tenderRepo, Request $request,
    PaginatorInterface $paginator): Response
    {
        $articles = $articleRepo->findBy([], ['created_at' => 'DESC']);
        $members = $memberRepo->findAll();
        
        //Paginate members in the homepage
        $members = $memberRepo->findBy([], ['created_at' => 'DESC']);

        $members = $paginator->paginate(
        $members, /* query NOT result */
        $request->query->getInt('page', 1),
            3
        );
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
