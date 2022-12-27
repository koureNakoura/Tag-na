<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TenderController extends AbstractController
{
    #[Route('/tender', name: 'app_tender')]
    public function index(): Response
    {
        return $this->render('tender/index.html.twig', [
            'controller_name' => 'TenderController',
        ]);
    }
}
