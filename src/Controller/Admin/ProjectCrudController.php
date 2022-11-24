<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Projet')
            ->setEntityLabelInPlural('Projets')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('title', 'Titre'),
            SlugField::new('slug')->setTargetFieldName('title'),
            ImageField::new('photo','Image')
               ->setUploadDir('/public/uploads/project_pictures')
               ->setBasePath('/uploads/project_pictures')
               ->setUploadedFileNamePattern('[timestamp]-[slug].[extension]'),
            TextareaField::new('content', 'Description')
         //   ->setFormType(CKEditorType::class)
            ->hideOnIndex(),
            DateField::new('created_at', 'Date de création')
                ->hideOnForm(),
            
        ];
    }

}
