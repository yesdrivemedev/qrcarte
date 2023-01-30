<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/menu', name: 'menu')]
    public function menu()
    {
        return $this->render('main/menu.html.twig');
    }
}
