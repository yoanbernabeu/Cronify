<?php

namespace App\Tests\Entities;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public const USER_EMAIL = 'test@test.com';
    public const USER_PASSWORD = 'test';
    public const USER_ROLES = ['ROLE_USER'];

    public function testIfTrue(): void
    {
        $user = new User();

        $user->setEmail(self::USER_EMAIL)
             ->setPassword(self::USER_PASSWORD)
             ->setRoles(self::USER_ROLES);

        $this->assertSame(self::USER_EMAIL, $user->getEmail());
        $this->assertSame(self::USER_PASSWORD, $user->getPassword());
        $this->assertSame(self::USER_ROLES, $user->getRoles());
    }

    public function testIfFalse(): void
    {
        $user = new User();

        $user->setEmail(self::USER_EMAIL)
             ->setPassword(self::USER_PASSWORD)
             ->setRoles(self::USER_ROLES);

        $this->assertNotSame('false', $user->getEmail());
        $this->assertNotSame('false', $user->getPassword());
        $this->assertNotSame('false', $user->getRoles());
    }

    public function testIfNull(): void
    {
        $user = new User();

        $this->assertNull($user->getEmail());
        $this->assertNull($user->getId());
    }
}
