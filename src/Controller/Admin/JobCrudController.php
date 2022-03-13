<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class JobCrudController extends AbstractCrudController
{
    public function __construct(
        public RequestStack $requestStack
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureFields(string $pageName): iterable
    {
        //get the current url
        //dd($this->requestStack->getCurrentRequest()->getSchemeAndHttpHost());
        return [
            TextField::new('name'),
            TextareaField::new('description'),
            AssociationField::new('app'),
            TextField::new('uuid')
                ->setDisabled(true),
            TextField::new('startEndpoint')
                ->setProperty('startEndpoint'),
        ];
    }
}
