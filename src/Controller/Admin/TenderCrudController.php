<?php

namespace App\Controller\Admin;

use App\Entity\Tender;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TenderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tender::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Appel d\'offre')
            ->setEntityLabelInPlural('Appels d\'offre')
            ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('object', 'Objet'),
           SlugField::new('slug')->setTargetFieldName('object'),
               
            TextareaField::new('content', 'Contenu')
         //   ->setFormType(CKEditorType::class)
            ->hideOnIndex(),
            DateField::new('closingDate', 'Date de cloture'),
                
            
            DateField::new('created_at', 'Date de création')
                ->hideOnForm(),
            
        ];
    }
}
