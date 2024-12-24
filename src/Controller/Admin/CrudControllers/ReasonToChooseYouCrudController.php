<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\ReasonToChooseYou;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReasonToChooseYouCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReasonToChooseYou::class;
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
