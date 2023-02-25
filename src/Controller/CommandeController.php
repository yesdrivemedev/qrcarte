<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Entity\Plat;
use App\Entity\Restaurant;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('{slug}/commande', name: 'app_commande')]
    public function index(Request $request, $slug): Response
    {

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



        $form = $this->createForm(CommandeType::class);
        $restaurant = $this->entityManager->getRepository(Restaurant::class)->findOneBySlug($slug);


        return $this->render('commande/index.html.twig', ['restaurant' => $restaurant, 'form' => $form->createView(), 'cart' => $carteComplete]);
    }

    #[Route('{slug}/commande/add', name: 'app_commande_add', methods: 'POST')]
    public function add(Request $request, $slug): Response
    {



        $restaurant = $this->entityManager->getRepository(Restaurant::class)->findOneBySlug($slug);


        $form = $this->createForm(CommandeType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $carriers = $form->get('carriers')->getData();
            $adresses = $form->get('adresses')->getData();

            //Enregistrer la commande

            $commande = new Commande();
            $commande->setRestaurant($restaurant);
            $commande->setCreatedAt($date);
            $commande->setNomcarrier($carriers->getNom());
            $commande->setPrixcarrier($carriers->getPrix());
            $commande->setAdresse($adresses->getNom());
            $commande->setCommandetable($adresses->getNom());
            $commande->setStatut('SENT');

            $this->entityManager->persist($commande);

            //Enregistrer les details de la commande

            $carteComplete = [];

            if ($request->getSession()->get('cart')) {
                $cart = $request->getSession()->get('cart');


                foreach ($cart as $id => $quantity) {


                    $carteComplete[] = [
                        'produit' => $this->entityManager->getRepository(Plat::class)->findOneById($id),
                        'quantity' => $quantity
                    ];
                }
            }

            foreach ($carteComplete as $item) {
                $commandeDetails = new CommandeDetails();
                $commandeDetails->setCommande($commande);
                $commandeDetails->setPlat($item['produit']->getNom());
                $commandeDetails->setPrix($item['produit']->getPrixsimple() / 100);
                $commandeDetails->setQuantite($item['quantity']);
                $commandeDetails->setTotal($item['produit']->getPrixsimple() * $item['quantity'] / 100);
                $this->entityManager->persist($commandeDetails);
            }

            // $this->entityManager->flush();
            return $this->render('commande/add.html.twig', ['restaurant' => $restaurant, 'form' => $form->createView(), 'cart' => $carteComplete, 'adresse' => $adresses, 'carrier' => $carriers]);
        }

        return $this->redirectToRoute('app_restaurant', ['slug' => $slug]);
    }
}
