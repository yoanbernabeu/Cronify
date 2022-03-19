<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RedirectResponse;

class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('description'),
            AssociationField::new('app'),
            TextField::new('uuid')
                ->setDisabled(true),
        ];
    }

    public function jobCronCodeGenerator(AdminContext $context): RedirectResponse
    {
        return $this->redirectToRoute('admin_job_cron_code', [
            'id' => $context->getEntity()->getInstance()->getId(),
        ]);
    }

    public function configureActions(Actions $actions): Actions
    {
        $test = Action::new('cronCode')
            ->setIcon('fas fa-code')
            ->setLabel('Cron Code')
            ->setCssClass('btn btn-primary')
            ->linkToCrudAction('jobCronCodeGenerator');

        $actions->add(Crud::PAGE_INDEX, $test);

        return $actions;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
        ;
    }
}
