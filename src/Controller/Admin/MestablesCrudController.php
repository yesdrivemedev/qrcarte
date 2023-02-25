<?php

namespace App\Controller\Admin;

use App\Entity\Mestables;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MestablesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mestables::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            AssociationField::new('restaurant'),
        ];
    }
}
