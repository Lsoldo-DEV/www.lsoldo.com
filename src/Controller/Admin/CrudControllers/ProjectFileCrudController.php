<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\ProjectFile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectFile::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('thumbnailFile')->setFormType(VichImageType::class)->setRequired(true)->hideOnDetail()->hideOnIndex(),
            TextField::new('videoFile')->setFormType(VichImageType::class)->hideOnDetail()->hideOnIndex(),


        ];
    }

}
