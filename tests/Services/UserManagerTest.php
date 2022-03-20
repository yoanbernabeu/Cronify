<?php

namespace App\Tests\Services;

use App\Entity\User;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserManagerTest extends KernelTestCase
{
    public function testShouldBeCreateNewUser(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());

        $userManager = static::getContainer()->get(UserManager::class);

        $this->assertInstanceOf(UserManager::class, $userManager);

        $user = $userManager->createUser('user@service.com', 'password');

        $this->assertInstanceOf(User::class, $user);
    }
}
