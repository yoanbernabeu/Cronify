<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $this->assertSame('test', $kernel->getEnvironment());

        $command = $application->find('app:create-user');

        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'username' => 'command@test.com',
            'password' => 'test',
        ]);

        $commandTester->assertCommandIsSuccessful();

        $this->assertStringContainsString('User created successfully!', $commandTester->getDisplay());
    }
}
