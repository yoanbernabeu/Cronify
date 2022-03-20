<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testShouldBeDisplayLoginPage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please sign in');
    }

    public function testShouldBeDisplayLoginPageAfterRedirection(): void
    {
        $client = static::createClient();

        $client->followRedirects();

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please sign in');

        $client->followRedirects();

        $client->submitForm('Sign in', [
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Your statistics');
    }

    public function testShouldBeDisplayLoginPageAndLoginLogout(): void
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please sign in');

        $crawler = $client->submitForm('Sign in', [
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        $this->assertResponseRedirects('/admin');

        $client->followRedirect();

        $client->request('GET', '/logout');
    }
}
