<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
            // ...
        ;
    }


    
    public function configureFields(string $pageName): iterable

    {
        $required = true; 
        if ($pageName =='edit'){
            $required = false;
        }
        
        return [
            
            TextField::new('name')->setLabel('Nom')->setHelp('Nom de votre produit'),
            BooleanField::new('isHomepage')->setLabel('Produit à la une ')->setHelp("Vous permet d'afficher un produit sur la Homepage "),
            SlugField::new('slug')->setTargetFieldName('name')->setLabel('URL')->setHelp('URL de votre produit'),
            TextEditorField::new('description')->setLabel('Description')->setHelp('description de votre produit'),
            
            ImageField::new('illustration')
            ->setLabel('image')
            ->setHelp('image du produit en 600x600px')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
            ->setBasePath('/uploads')->setUploadDir('/public/uploads')
            ->setRequired($required)
            ,
            NumberField::new('price')->setLabel('Prix H.T')->setHelp('Prix Hors taxe du produit sans le sigle €.'),
            ChoiceField::new('tva')->setLabel('Taux de tva')->setChoices([
                '5.5%' => '5.5', 
                '10%'  => '10', 
                '20%'  => '20'

            ]), 
            AssociationField::new('category', 'Catégorie associée')

        ];
    }
   
}
