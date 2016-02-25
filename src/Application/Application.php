<?php

namespace TwitterBis\Application;

use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\DataStructure\SortedListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Entity\User;
use TwitterBis\IO\IOHandlerInterface;

class Application
{
    const EXIT_COMMAND = 'exit';

    /** @var  IOHandlerInterface */
    private $ioHandler;
    /** @var  UserSetInterface */
    private $users;
    /** @var  SortedListInterface */
    private $messages;

    /**
     * Application constructor.
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param SortedListInterface $messages
     */
    public function __construct(IOHandlerInterface $ioHandler, UserSetInterface $users, SortedListInterface $messages)
    {
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
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
    public function readCommand()
    {
        $this->ioHandler->writeLine('INTRODUCE COMMAND (TYPE "exit" TO FINISH):');
        return trim($this->ioHandler->readLine());
    }

}