<?php

namespace App\Controller\Admin;

use App\Entity\App;
use App\Entity\Cron;
use App\Entity\Job;
use App\Repository\CronRepository;
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
        public ChartManager $chartManager,
        public CronRepository $cronRepository
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if (0 === count($this->cronRepository->findAll())) {
            return $this->render('admin/index.html.twig');
        }

        return $this->render('admin/index.html.twig', [
            'chart' => $this->chartManager->getHomepageChart(),
        ]);
    }

    #[Route('/admin/job-cron-code/{id}', name: 'admin_job_cron_code')]
    public function cronCode(Job $job): Response
    {
        return $this->render('admin/job_cron_code.html.twig', [
            'job' => $job,
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
