<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\Testmonial;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TestmonialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testmonial::class;
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
