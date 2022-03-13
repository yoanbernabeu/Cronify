<?php

namespace App\Service;

use App\Entity\Cron;
use App\Repository\JobRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartManager
{
    public function __construct(
        public ChartBuilderInterface $chartBuilder,
        public JobRepository $jobRepository
    ) {
    }

    public function getHomepageChart(): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $jobs = $this->jobRepository->findAll();

        foreach ($jobs as $job) {
            $labels[] = $job->getName();

            $crons = $job->getCrons();
            $numberOfCron[] = count($crons);

            $success = 0;
            $failure = 0;
            $running = 0;

            foreach ($crons as $cron) {
                if ($cron->getStatus() === Cron::$STATUS_SUCCESS) {
                    ++$success;
                }
                if ($cron->getStatus() === Cron::$STATUS_FAILURE) {
                    ++$failure;
                }
                if ($cron->getStatus() === Cron::$STATUS_RUNNING) {
                    ++$running;
                }
            }

            $numberOfCronSuccess[] = $success;
            $numberOfCronFailure[] = $failure;
            $numberOfCronRunning[] = $running;
        }

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total',
                    'backgroundColor' => 'rgb(2, 128, 247)',
                    'borderColor' => 'rgb(2, 128, 247)',
                    'data' => $numberOfCron,
                ],
                [
                    'label' => 'Success',
                    'backgroundColor' => 'rgb(166, 220, 117)',
                    'borderColor' => 'rgb(166, 220, 117)',
                    'data' => $numberOfCronSuccess,
                ],
                [
                    'label' => 'Failure',
                    'backgroundColor' => 'rgb(226, 67, 41)',
                    'borderColor' => 'rgb(226, 67, 41)',
                    'data' => $numberOfCronFailure,
                ],
                [
                    'label' => 'Running',
                    'backgroundColor' => 'rgb(142, 155, 172)',
                    'borderColor' => 'rgb(142, 155, 172)',
                    'data' => $numberOfCronRunning,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 10,
                ],
            ],
        ]);

        return $chart;
    }
}
