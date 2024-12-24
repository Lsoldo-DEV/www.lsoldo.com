<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\ServiceDescription;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceDescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiceDescription::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
