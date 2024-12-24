<?php

namespace App\Controller\Admin\CrudControllers;

use App\Utils\Constant;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

abstract class AbstractCustomCrudController extends AbstractCrudController
{

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission(Constant::ROLE_USER);
            // ...
            #->showEntityActionsInlined()            ;
    }
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function  configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX,Action::DETAIL);
    }

}