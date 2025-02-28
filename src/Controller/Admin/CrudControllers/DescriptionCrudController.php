<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\Description;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class DescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Description::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextEditorField::new('content')->setLabel('Contenu'),
            TextField::new('summary')->setLabel('Résumé'),
            ChoiceField::new('lang')->setLabel('Langue')
                ->setChoices([
                    'Français' => 'fr',
                    'English' => 'en',
                ])
                ->renderAsNativeWidget(), // Affiche un menu déroulant
            DateTimeField::new('publishedAt')->setLabel('Date de publication'),
            AssociationField::new('tags')->setLabel('Tags'),
            AssociationField::new('post')->setLabel('Post'),
        ];
    }
}



