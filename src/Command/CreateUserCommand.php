<?php

// src/Command/CreateUserCommand.php

namespace App\Command;

use App\Service\UserManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user.',
    hidden: false,
    aliases: ['app:add-user']
)]
class CreateUserCommand extends Command
{
    public function __construct(
        public UserManager $userManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'The plain password of the user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $user = $this->userManager->createUser($username, $password);

        $output->writeln([
            'User created successfully!',
            '',
            'Username: '.$user->getEmail(),
        ]);

        return Command::SUCCESS;
    }
}
