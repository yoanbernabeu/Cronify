<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CronControllerTest extends WebTestCase
{
    public function testShouldBeDisplayCronList(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        $client->loginUser($testUser);

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $client->clickLink('Cron');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Cron');
    }
}
