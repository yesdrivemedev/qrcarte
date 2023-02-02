<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
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

    #[Route('/menu/{secret}/{restau}', name: 'qrmenu')]
    public function saintgermain($secret, $restau)
    {

        $filepath  = $this->getParameter('kernel.project_dir') . '\public\json\restautants_db.json';
        $json_string = file_get_contents($filepath);
        $json = json_decode($json_string, true);
        //Steven Miller - Red

        $nom = 'Zeze';

        foreach ($json as $elem) {
            //  echo ($elem['name'] . " - " . $elem['favourite']['statut']);
            if ($elem['code'] == $restau && $elem['token']['statut'] == 'OK' && $elem['token']['secret'] == $secret)  $nom = $elem['name'];
            //echo ("<br/>");
        }


        // echo ("<br/>");
        // echo $nom;
        //  die();
        return $this->render('main/qrmenu.html.twig', ['nom' => $nom]);
    }
}
