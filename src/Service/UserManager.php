<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    public function __construct(
        public EntityManagerInterface $entityManager,
        public UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function createUser(string $username, string $password): User
    {
        $user = new User();
        $user->setEmail($username);
        $user->setPassword($this->encodePassword($user, $password));
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    private function encodePassword(User $user, string $password): string
    {
        return $this->passwordHasher->hashPassword($user, $password);
    }
}
