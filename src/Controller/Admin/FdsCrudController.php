<?php

namespace App\Controller\Admin;

use App\Entity\Fds;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FdsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fds::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('description'),
            IntegerField::new('version'),
            TextField::new('pdf_link'),
            DateTimeField::new('creation_date'),
            DateTimeField::new('last_updated'),
            AssociationField::new('products')
            
        ];
    }
    
}
