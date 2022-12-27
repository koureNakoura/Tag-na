<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Membre')
            ->setEntityLabelInPlural('Les membres')
            ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [

            ImageField::new('profilePicture','Photo de profil')
                ->setUploadDir('/public/uploads/profile_pictures')
                ->setBasePath('/uploads/profile_pictures')
                ->setUploadedFileNamePattern('[timestamp]-[slug].[extension]'),
            TextField::new('full_name', 'Nom et Prénom'),       
        //   SlugField::new('slug')->setTargetFieldName('object'),
             TextField::new('email', 'Email'),
             TextField::new('phoneNumber', 'Numéro téléphone'),
             TextField::new('quality', 'Poste occupé'),
             TextField::new('faceBookProfile', 'Profile Facebook'),
             TextField::new('tweeterProfile', 'Profile Tweeter'),
             TextField::new('linkedInProfile', 'Profile LinkedIn'),
         //   TextareaField::new('content', 'Contenu'),
         //   ->setFormType(CKEditorType::class)
                         
            DateField::new('created_at', 'Date de création')
                ->hideOnForm(),
            
        ];
    }
}
