<?php

namespace App\Tests\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EndpointControllerTest extends WebTestCase
{
    public function testShouldBeStartCron(): void
    {
        $client = static::createClient();

        $container = static::getContainer();
        $jobRepository = $container->get(JobRepository::class);

        $job = $jobRepository->findOneBy(['id' => 1]);
        $crawler = $client->request('GET', '/endpoint/'.$job->getUuid().'/start');

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('running', $data['status']);
    }

    public function testShouldBeStopCron(): void
    {
        $client = static::createClient();

        $container = static::getContainer();
        $jobRepository = $container->get(JobRepository::class);

        $job = $jobRepository->findOneBy(['id' => 1]);
        $crawler = $client->request('GET', '/endpoint/'.$job->getUuid().'/stop');

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('success', $data['status']);
    }

    public function testShouldBeFailureCron(): void
    {
        $client = static::createClient();

        $container = static::getContainer();
        $jobRepository = $container->get(JobRepository::class);

        $job = $jobRepository->findOneBy(['id' => 1]);
        $crawler = $client->request('GET', '/endpoint/'.$job->getUuid().'/failure');

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('failure', $data['status']);
    }
}
