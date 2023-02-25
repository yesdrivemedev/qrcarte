<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('description'),
            MoneyField::new('prixsimple')->setCurrency('XOF'),
            MoneyField::new('prixdouble')->setCurrency('XOF'),
            TextField::new('filtre'),
            AssociationField::new('categorie'),
            BooleanField::new('isDispo'),

        ];
    }
}
