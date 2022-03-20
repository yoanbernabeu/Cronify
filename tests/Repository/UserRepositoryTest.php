<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    public function testShouldBeCreateNewUser(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $userRepository = static::getContainer()->get(UserRepository::class);

        $this->assertInstanceOf(UserRepository::class, $userRepository);

        $user = new User();
        $user->setEmail('test@test.com')
            ->setPassword('test')
            ->setRoles(['ROLE_USER']);

        $userRepository->add($user);
    }

    public function testShouldBeCreateNewUserAndRemove(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $userRepository = static::getContainer()->get(UserRepository::class);

        $this->assertInstanceOf(UserRepository::class, $userRepository);

        $user = new User();
        $user->setEmail('test2@test.com')
            ->setPassword('test')
            ->setRoles(['ROLE_USER']);

        $userRepository->add($user);

        $userRepository->remove($user);
    }

    public function testShouldBeCreateNewUserAndUpgradePasswordWithValidUser(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $userRepository = static::getContainer()->get(UserRepository::class);

        $this->assertInstanceOf(UserRepository::class, $userRepository);

        $user = new User();
        $user->setEmail('test3@test.com')
            ->setPassword('test')
            ->setRoles(['ROLE_USER']);

        $userRepository->add($user);

        $userRepository->upgradePassword($user, 'test2');
    }
}
