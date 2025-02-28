<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\ProjectFile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ProjectFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectFile::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = iterator_to_array(parent::configureFields($pageName));

        $fields = array_filter($fields, function ($field) {
            return !in_array($field->getAsDto()->getProperty(), ['thumbnail', 'videoUrl']);
        });

        yield from $fields;

        yield AssociationField::new('projects', 'Projects')->autocomplete();

        yield TextField::new('thumbnailFile')
            ->setFormType(VichImageType::class)
            ->setRequired(true)
            ->hideOnDetail()
            ->hideOnIndex();
        yield ImageField::new('thumbnail')
            ->setBasePath('/uploads/images/project/thumbnails')
            ->onlyOnIndex();

        yield TextField::new('videoFile')->setFormType(VichFileType::class)
            ->hideOnDetail()
            ->hideOnIndex();
        yield UrlField::new('videoUrl')->onlyOnIndex();
        yield ImageField::new('videoUrl')
            ->setBasePath('/uploads/videos/projets')
            ->onlyOnIndex();
    }
}
