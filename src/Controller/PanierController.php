<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/{slug}/panier', name: 'app_panier')]
    public function index(Request $request, $slug): Response
    {


        $restaurant = $this->entityManager->getRepository(Restaurant::class)->findOneBySlug($slug);
        $carteComplete = [];


        if ($request->getSession()->get('cart')) {
            $cart = $request->getSession()->get('cart');


            foreach ($cart as $id => $quantity) {


                $carteComplete[] = [
                    'produit' => $this->entityManager->getRepository(Plat::class)->findOneById($id),
                    'quantity' => $quantity
                ];
            }
        } else {
            return $this->redirectToRoute('app_restaurant', ['slug' => $slug]);
        }

        return $this->render('panier/index.html.twig', ['cart' => $carteComplete, 'restaurant' => $restaurant]);
    }


    #[Route('/{slug}/panier/add/{id}', name: 'app_panier_add')]
    public function add(Request $request, $slug,  $id): Response
    {
        $session = $request->getSession();

        $cart = $session->get('cart');


        if (!empty($cart[$id])) {

            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart',  $cart);


        return $this->redirectToRoute('app_panier', ['slug' => $slug]);
    }

    #[Route('{slug}/panier/remove', name: 'app_panier_remove')]
    public function remove(Request $request, $slug): Response
    {
        $session = $request->getSession();
        $session->remove('cart');

        return $this->redirectToRoute('app_panier', ['slug' => $slug]);
    }



    #[Route('{slug}/panier/delete/{id}', name: 'app_panier_delete')]
    public function delete(Request $request, $slug, $id): Response
    {
        $session  = $request->getSession();
        $cart = $session->get('cart');
        unset($cart[$id]);

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_panier', ['slug' => $slug]);
    }

    #[Route('{slug}/panier/supprimer/{id}', name: 'app_panier_supprimer')]
    public function supprimer(Request $request, $slug, $id): Response
    {
        $session  = $request->getSession();
        $cart = $session->get('cart');

        if ($cart[$id] > 1) {
            $cart[$id]--;
        } elseif ($cart[$id]  == 1) {

            unset($cart[$id]);
        }


        $session->set('cart', $cart);

        return $this->redirectToRoute('app_panier', ['slug' => $slug]);
    }
}
