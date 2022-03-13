<?php

namespace App\Controller\Admin;

use App\Entity\App;
use App\Entity\Cron;
use App\Entity\Job;
use App\Repository\JobRepository;
use App\Service\ChartManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        public JobRepository $jobRepository,
        public ChartManager $chartManager
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'chart' => $this->chartManager->getHomepageChart(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cronify');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Cron', 'fas fa-play', Cron::class);
        yield MenuItem::linkToCrud('App', 'fas fa-rocket', App::class);
        yield MenuItem::linkToCrud('Job', 'fas fa-list', Job::class);
    }
}
