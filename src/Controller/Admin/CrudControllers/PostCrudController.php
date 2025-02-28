<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')->hideOnForm(), 
        TextField::new('slug')->setLabel('Slug'),
        DateTimeField::new('publishedAt')->setLabel('Date de publication'),
        AssociationField::new('author')->setLabel('Auteur')->autocomplete(),
        AssociationField::new('description')->setLabel('Descriptions')->hideOnIndex(),
        TextField::new('lang')->setLabel('Langue'),
        
        // Champ pour l'upload de l'image avec VichUploader
        ImageField::new('thumbnail')
            ->setLabel('Image')
            ->setBasePath('/uploads/images/post/thumbnails')
            ->onlyOnIndex(),

        // Champ pour gérer l'upload via VichUploader dans le formulaire
        TextField::new('thumbnailFile')
            ->setLabel('Image')
            ->setFormType(VichImageType::class)
            ->onlyOnForms()
            ->hideOnDetail()
            ->hideOnIndex(),
        
        DateTimeField::new('updateAt')->setLabel('Dernière mise à jour')->hideOnForm(),
    ];
}
}


