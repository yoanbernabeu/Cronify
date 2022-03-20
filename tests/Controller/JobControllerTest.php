<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobControllerTest extends WebTestCase
{
    public function testShouldBeDisplayJobList(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        $client->loginUser($testUser);

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $client->clickLink('Job');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Job');
    }

    public function testShouldBeDisplayJobCronCode(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        $client->loginUser($testUser);

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $client->clickLink('Job');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Job');

        $client->followRedirects();
        $client->clickLink('Cron Code');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h2', 'Code snippet (with Curl)');
    }
}
