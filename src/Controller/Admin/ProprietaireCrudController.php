<?php

namespace App\Controller\Admin;

use App\Entity\Proprietaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class ProprietaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Proprietaire::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('prenom'),
            AssociationField::new('user'),
            TelephoneField::new('telephone'),
            EmailField::new('email'),
            TextField::new('adresse'),


        ];
    }
}
