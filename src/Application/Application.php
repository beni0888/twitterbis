<?php

namespace TwitterBis\Application;

use TwitterBis\Application\Command\CommandFactory;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Entity\User;
use TwitterBis\Exception\InvalidArgumentException;
use TwitterBis\Exception\InvalidCommandException;
use TwitterBis\IO\IOHandlerInterface;
use TwitterBis\IO\StandardIOHandler;

class Application
{
    const EXIT_COMMAND = 'exit';
    const COMMAND_BUILDERS_DIRECTORY = __DIR__ . '/Command/Builder';

    /** @var IOHandlerInterface */
    private $ioHandler;
    /** @var UserSetInterface */
    private $users;
    /** @var MessageListInterface */
    private $messages;
    /** @var CommandFactory */
    private $commandFactory;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->ioHandler = new StandardIOHandler();
        $this->users = new InMemoryUserSet();
        $this->messages = new InMemoryMessageList(new InMemoryReversedSortedList());

        $this->commandFactory = new CommandFactory(self::COMMAND_BUILDERS_DIRECTORY, $this->ioHandler, $this->users, $this->messages);
    }

    /**
     * @param IOHandlerInterface $ioHandler
     */
    public function setIoHandler($ioHandler)
    {
        $this->ioHandler = $ioHandler;
    }

    /**
     * @param UserSetInterface $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @param MessageListInterface $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    /**
     * @param CommandFactory $commandFactory
     */
    public function setCommandFactory($commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }

    /**
     * Read a list of users from the input and store them into the application.
     */
    public function loadUsers()
    {
        $this->ioHandler->writeLine('INTRODUCE A LIST OF USERS (ONE PER LINE, EMPTY LINE TO FINISH):');
        while ($userName = trim($this->ioHandler->readLine())) {
            $this->users->add(new User(trim($userName), new InMemoryUserSet()));
        }
    }

    /**
     * Read a command from the input.
     * @return string
     */
    public function readCommandFromInput()
    {
        $this->ioHandler->writeLine('INTRODUCE COMMAND (TYPE "exit" TO FINISH):');
        return trim($this->ioHandler->readLine());
    }

    /**
     * Execute a command.
     *
     * @param $commandString
     * @return void
     * @throws InvalidCommandException
     */
    public function executeCommand($commandString)
    {
        $command = $this->commandFactory->getCommand($commandString);
        $command->run();
    }

    /**
     * Execute the application.
     */
    public function run()
    {
        $this->loadUsers();

        while (self::EXIT_COMMAND !== ($command = $this->readCommandFromInput())) {
            try {
                $this->executeCommand($command);
            } catch (InvalidArgumentException $e) {
                $this->ioHandler->writeLine(sprintf('ERROR: %s', $e->getMessage()));
            }
        }

        $this->ioHandler->writeLine('BYE!');
    }
}