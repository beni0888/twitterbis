<?php

namespace TwitterBis\Application;

use TwitterBis\Application\Command\Parser;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Entity\User;
use TwitterBis\Exception\InvalidCommandException;
use TwitterBis\IO\IOHandlerInterface;

class Application
{
    const EXIT_COMMAND = 'exit';

    /** @var IOHandlerInterface */
    private $ioHandler;
    /** @var UserSetInterface */
    private $users;
    /** @var MessageListInterface */
    private $messages;
    /** @var Parser */
    private $commandParser;

    /**
     * Application constructor.
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param MessageListInterface $messages
     * @param Parser $commandParser
     */
    public function __construct(IOHandlerInterface $ioHandler, UserSetInterface $users, MessageListInterface $messages, Parser $commandParser)
    {
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
        $this->commandParser = $commandParser;
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
        $this->commandParser->parse($commandString)->run();
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
            } catch (\Exception $e) {
                $this->ioHandler->writeLine(sprintf('ERROR: %s', $e->getMessage()));
            }
        }

        $this->ioHandler->writeLine('BYE!');
    }
}