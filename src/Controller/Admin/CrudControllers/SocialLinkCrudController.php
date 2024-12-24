<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\SocialLink;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SocialLinkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SocialLink::class;
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
