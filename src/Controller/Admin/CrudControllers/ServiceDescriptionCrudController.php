<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\ServiceDescription;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ServiceDescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiceDescription::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = iterator_to_array(parent::configureFields($pageName));

        // Filtrer pour exclure les champs 'topImage' et 'endImage'
        $fields = array_filter($fields, function ($field) {
            return !in_array($field->getAsDto()->getProperty(), ['top_image', 'end_image']);
        });

        // Retourner les champs filtrés + les champs customisés
        yield from $fields;

        // Champs pour uploader les images
        yield TextField::new('topImageFile')
            ->setFormType(VichImageType::class)
            ->setRequired(false)
            ->hideOnIndex()
            ->hideOnDetail();

        yield ImageField::new('top_image')
            ->setBasePath('/uploads/images/service/top_end_images')
            ->onlyOnIndex();

        yield TextField::new('endImageFile')
            ->setFormType(VichImageType::class)
            ->setRequired(false)
            ->hideOnIndex()
            ->hideOnDetail();

        yield ImageField::new('end_image')
            ->setBasePath('/uploads/images/service/top_end_images')
            ->onlyOnIndex();
    }
}
