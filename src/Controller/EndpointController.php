<?php

namespace App\Controller;

use App\Entity\Job;
use App\Service\JobService;
use App\Service\JsonResponseMaker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndpointController extends AbstractController
{
    public function __construct(
        public JobService $jobService,
        public JsonResponseMaker $jsonResponseMaker
    ) {
    }

    #[Route('/endpoint/{uuid}/start', name: 'app_endpoint_start')]
    public function start(Job $job): Response
    {
        $cron = $this->jobService->startJob($job);

        return $this->jsonResponseMaker->makeJsonResponse($this->jobService->CronResponse($cron));
    }

    #[Route('/endpoint/{uuid}/stop', name: 'app_endpoint_stop')]
    public function stop(Job $job): Response
    {
        $cron = $this->jobService->stopJobinSuccess($job);

        return $this->jsonResponseMaker->makeJsonResponse($this->jobService->CronResponse($cron));
    }

    #[Route('/endpoint/{uuid}/failure', name: 'app_endpoint_failure')]
    public function failure(Job $job): Response
    {
        $cron = $this->jobService->stopJobinFailure($job);

        return $this->jsonResponseMaker->makeJsonResponse($this->jobService->CronResponse($cron));
    }
}
