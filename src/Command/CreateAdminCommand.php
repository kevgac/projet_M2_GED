<?php

namespace App\Command;

use App\Entity\Customers;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use App\Repository\CustomersRepositoryRepository;
use App\Repository\CustomersRepository;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Créer un utilisateur avec le rôle admin',
)]
class CreateAdminCommand extends Command
{
    private SymfonyStyle $io;
    public function __construct(
        private readonly CustomersRepository $repository,
        private readonly UserPasswordHasherInterface $hasher    
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('first_name', InputArgument::OPTIONAL, 'the first name')
            ->addArgument('last_name', InputArgument::OPTIONAL, 'the last name')
            ->addArgument('email', InputArgument::OPTIONAL, 'the email')
            ->addArgument('password', InputArgument::OPTIONAL, 'the password')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
    if (
        null !== $input->getArgument('email') &&
        null !== $input->getArgument('password') &&
        null !== $input->getArgument('first_name') &&
        null !== $input->getArgument('last_name')
    ) {
            return;
        }

        $this->io->title('Add admin command interactive wizard');
        $this->askArgument($input, 'email');
        $this->askArgument($input, 'password', hidden: true);
        $this->askArgument($input, 'first_name');
        $this->askArgument($input, 'last_name');
    }

    private function askArgument(InputInterface $input, string $name, bool $hidden = false): void
    {
        $value = strval($input->getArgument($name));
        if('' !== $value)
        {
            $this->io->text((sprintf('> <info>%s</info> : %s', $name, $value)));
        }else{
            $value = match($hidden){
            false => $this->io->ask($name),
            default => $this->io->askHidden($name),
            };
            $input->setArgument($name, $value);
        }
       
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new Customers();
        $user->setEmail(strval($input->getArgument('email')));
        $user->setPassword($this->hasher->hashPassword($user, strval($input->getArgument('password'))));
        $user->setFirstName(strval($input->getArgument('first_name')));
        $user->setLastName(strval($input->getArgument('last_name')));
        
        $user->setRoles(['ROLE_ADMIN']);
        $this->repository->save($user, true);

        return Command::SUCCESS;
    }
}
