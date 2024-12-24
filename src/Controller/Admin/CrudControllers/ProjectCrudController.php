<?php

namespace App\Controller\Admin\CrudControllers;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(), // Affiche uniquement dans la liste
            TextField::new('title', 'Title'), // Champ texte pour le titre
            TextareaField::new('briefDescription', 'Brief Description')->hideOnIndex(), // Champ texte pour la description courte
            TextareaField::new('fullDescription', 'Full Description')->hideOnIndex(), // Champ texte pour la description complète
            ChoiceField::new('technologies', 'Technologies') // Champ de choix pour les technologies
            ->setChoices([
                'PHP' => 'PHP',
                'Symfony' => 'Symfony',
                'JavaScript' => 'JavaScript',
                'Vue.js' => 'Vue.js',
                'React' => 'React',
            ])
                ->allowMultipleChoices(true), // Permet de sélectionner plusieurs technologies
            UrlField::new('projectLink', 'Project Link')->hideOnIndex(), // Lien vers le projet
            DateTimeField::new('createdAt', 'Created At')->onlyOnIndex(), // Date de création
            DateTimeField::new('updatedAt', 'Updated At')->hideOnIndex(), // Date de mise à jour
            AssociationField::new('tags', 'Tags')->autocomplete(), // Relation ManyToMany avec `Tag`, avec autocomplétion
            AssociationField::new('projectFiles', 'ProjectFile')->autocomplete(),
            TextField::new('lang', 'Language'), // Langue du projet
        ];
    }

}
