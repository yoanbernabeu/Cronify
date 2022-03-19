<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testShouldBeDisplayAppList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $client->clickLink('App');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'App');
    }

    public function testShouldBeAddApp(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $client->clickLink('App');

        $this->assertResponseIsSuccessful();

        $client->clickLink('Add App');

        $this->assertResponseIsSuccessful();

        $client->followRedirects();

        $client->submitForm('Create', [
            'App[name]' => 'Test App',
            'App[description]' => 'Test App Description',
        ]);

        $this->assertResponseIsSuccessful();
    }
}
