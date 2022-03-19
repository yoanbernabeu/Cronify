<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CronControllerTest extends WebTestCase
{
    public function testShouldBeDisplayCronList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $client->clickLink('Cron');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Cron');
    }
}
