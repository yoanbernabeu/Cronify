<?php

namespace App\Controller\Admin;

use App\Entity\App;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AppCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return App::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('description'),
            TextField::new('uuid')
                ->setDisabled(true),
        ];
    }
}
