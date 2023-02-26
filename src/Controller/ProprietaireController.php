<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Entity\User;
use App\Form\ProprietaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProprietaireController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/proprietaire', name: 'app_proprietaire')]
    public function index(): Response
    {
        return $this->render('proprietaire/index.html.twig', [
            'controller_name' => 'ProprietaireController',
        ]);
    }

    #[Route('moncompte/proprietaire/add', name: 'app_proprietaire_add')]
    public function add(Request $request): Response
    {

        $proprio = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprio);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $proprio = $form->getData();
            $proprio->setUser($this->getUser());
            $this->entityManager->persist($proprio);

            $user = $this->entityManager->getRepository(User::class)->find($this->getUser());
            $user->setIsProprietaire(true);
            $this->entityManager->persist($user);


            $this->entityManager->flush();

            return  $this->redirectToRoute('app_account');
        }



        return $this->render('proprietaire/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
