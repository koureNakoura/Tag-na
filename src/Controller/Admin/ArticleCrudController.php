<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Article')
            ->setEntityLabelInPlural('Articles')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('title', 'Titre'),
            SlugField::new('slug')->setTargetFieldName('title'),
            ImageField::new('photo','Image')
               ->setUploadDir('/public/uploads/blog_pictures')
               ->setBasePath('/uploads/blog_pictures')
               ->setUploadedFileNamePattern('[timestamp]-[slug].[extension]'),
            TextareaField::new('content', 'Contenu')
         //   ->setFormType(CKEditorType::class)
            ->hideOnIndex(),
            DateField::new('created_at', 'Date de création')
                ->hideOnForm(),
            
        ];
    }
    
}
