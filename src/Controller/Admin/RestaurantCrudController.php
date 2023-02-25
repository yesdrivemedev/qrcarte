<?php

namespace App\Controller\Admin;

use App\Entity\Proprietaire;
use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\EntityManagerInterface;


class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }


    public function configureFields(string $pageName): iterable
    {



        return [
            TextField::new('nom'),
            AssociationField::new('proprietaire'),
            SlugField::new('slug')->setTargetFieldName('nom'),
            TextField::new('css'),
            ImageField::new('illustration')->setUploadedFileNamePattern('[year][month][day]-[slug]-[contenthash].[extension]')->setUploadDir('public/uploads/')->setBasePath('uploads/'),
            TelephoneField::new('telephone'),
            EmailField::new('email'),
            TextField::new('adresse'),
            TextField::new('nomcourtright'),
            TextField::new('nomcourtleft'),
            TextField::new('description'),
            TextField::new('phrase1'),
            TextField::new('phrase2'),
            TextField::new('phrase3'),
            BooleanField::new('isActif'),


        ];
    }
}
