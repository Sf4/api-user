<?php

namespace Sf4\ApiUser\Command;

use Doctrine\ORM\EntityManager;
use Exception;
use Sf4\Api\Setting\StatusSettingInterface;
use Sf4\ApiUser\EntitySaver\UserCreator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUserCommand extends Command
{

    protected const EMAIL = 'email';
    protected const PASSWORD = 'password';
    protected const IS_ADMIN = 'is_admin';

    protected const FIRST_NAME_QUESTION = 'Please enter the first name of the user:';
    protected const LAST_NAME_QUESTION = 'Please enter the last name of the user:';
    protected const EMAIL_QUESTION = 'Please enter the email of the user:';
    protected const PASSWORD_QUESTION = 'Please enter the password of the user:';
    protected const IS_ADMIN_QUESTION = 'Is this user admin? [Y/N]:';

    protected const IS_ADMIN_YES = 'Y';
    protected const IS_ADMIN_NO = 'N';

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    /** @var EntityManager */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            ''
        ]);

        $this->createUser($input, $output);

        $output->writeln('User created');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function createUser(InputInterface $input, OutputInterface $output)
    {
        $firstName = $this->getFirstName($input, $output);
        $lastName = $this->getLastName($input, $output);
        $email = $this->getEmail($input, $output);
        $password = $this->getPassword($input, $output);
        $isAdmin = $this->isAdmin($input, $output);

        $data = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
            'roles' => $isAdmin ? 'ROLE_SUPER_ADMIN' : 'ROLE_USER',
            'status' => StatusSettingInterface::ACTIVE,
            'create_api_token' => true
        ];

        try {
            $userCreator = new UserCreator($this->entityManager);
            $userCreator->create($data);
        } catch (Exception $e) {
            $output->writeln($e->getMessage());
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return string
     */
    protected function getFirstName(InputInterface $input, OutputInterface $output): string
    {
        return $this->getAnswer($input, $output, static::FIRST_NAME_QUESTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param string $questionText
     * @param string $default
     * @return string
     */
    protected function getAnswer(
        InputInterface $input,
        OutputInterface $output,
        string $questionText,
        string $default = ''
    ): string {
        $helper = $this->getHelper('question');
        $question = new Question($questionText, $default);

        return $helper->ask($input, $output, $question);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return string
     */
    protected function getLastName(InputInterface $input, OutputInterface $output): string
    {
        return $this->getAnswer($input, $output, static::LAST_NAME_QUESTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return string
     */
    protected function getEmail(InputInterface $input, OutputInterface $output): string
    {
        return $this->getAnswer($input, $output, static::EMAIL_QUESTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return string
     */
    protected function getPassword(InputInterface $input, OutputInterface $output): string
    {
        return $this->getAnswer($input, $output, static::PASSWORD_QUESTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return bool
     */
    protected function isAdmin(InputInterface $input, OutputInterface $output): bool
    {
        $isAdmin = $this->getAnswer($input, $output, static::IS_ADMIN_QUESTION, static::IS_ADMIN_YES);
        if (in_array($isAdmin, [static::IS_ADMIN_YES, static::IS_ADMIN_NO]) === false) {
            return $this->isAdmin($input, $output);
        }

        return $isAdmin === static::IS_ADMIN_YES;
    }
}
