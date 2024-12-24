<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\SettingsOption;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LanguageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SettingsOptionCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return SettingsOption::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('label')
            ->add('lang')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        switch ($pageName){
            case Crud::PAGE_DETAIL:
                yield TextField::new('label');
                yield    TextField::new('name');
                yield  TextEditorField::new('value');
                yield LanguageField::new('lang')->includeOnly(['fr','en']);
                break;
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                yield TextField::new('label');
                yield    TextField::new('name');
                yield  TextEditorField::new('value');
                yield LanguageField::new('lang')->includeOnly(['fr','en']);
                break;
            default:
                yield IdField::new('id')->hideOnForm();
                yield LanguageField::new('lang')->includeOnly(['fr','en']);
                yield    TextField::new('label');
                break;
        }
    }
}
