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

    #[Route('/menu/327379006c7d21ce78bd69d59c7e5b5b/saintgermain', name: 'saintgermain')]
    public function saintgermain()
    {
        return $this->render('main/saintgermain.html.twig');
    }
}
