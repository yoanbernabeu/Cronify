<?php

namespace App\Controller\Admin;

use App\Entity\Cron;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CronCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cron::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            AssociationField::new('job'),
            DateTimeField::new('startAt'),
            DateTimeField::new('endAt'),
            ChoiceField::new('status')
                ->renderAsBadges([
                    Cron::$STATUS_PENDING => 'secondary',
                    Cron::$STATUS_RUNNING => 'primary',
                    Cron::$STATUS_SUCCESS => 'success',
                    Cron::$STATUS_FAILURE => 'danger',
                ])
                ->setChoices([
                    Cron::$STATUS_PENDING => Cron::$STATUS_PENDING,
                    Cron::$STATUS_RUNNING => Cron::$STATUS_RUNNING,
                    Cron::$STATUS_SUCCESS => Cron::$STATUS_SUCCESS,
                    Cron::$STATUS_FAILURE => Cron::$STATUS_FAILURE,
                ]),
        ];
    }
}
