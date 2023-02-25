<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    #[Route('/restaurant/{slug}', name: 'app_restaurant')]
    public function index(Request $request, $slug): Response
    {
        $restaurant = $this->entityManager->getRepository(Restaurant::class)->findOneBySlug($slug);

        $nombre_produit = 0;
        if ($request->getSession()->get('cart')) {

            $nombre_produit = count($request->getSession()->get('cart'));
        }
        return $this->render('restaurant/index.html.twig', ['restaurant' => $restaurant, 'nombre_produit' => $nombre_produit]);
    }
}
