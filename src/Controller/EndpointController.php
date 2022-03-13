<?php

namespace App\Controller;

use App\Entity\Job;
use App\Service\JobService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndpointController extends AbstractController
{
    public function __construct(
        public JobService $jobService
    ) {
    }

    #[Route('/endpoint/{uuid}/start', name: 'app_endpoint')]
    public function index(Job $job): Response
    {
        $cron = $this->jobService->startJob($job);

        $response = new Response();

        $response->setContent(json_encode([
            'status' => 'success',
            'cron' => $cron
        ]));
        
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
