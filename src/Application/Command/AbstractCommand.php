<?php

namespace TwitterBis\Application\Command;

use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Exception\InvalidUserException;
use TwitterBis\IO\IOHandlerInterface;

abstract class AbstractCommand
{
    /** @var  IOHandlerInterface */
    protected $ioHandler;
    /** @var  UserSetInterface */
    protected $users;
    /** @var  MessageListInterface */
    protected $messages;
    /** @var array */
    private $arguments = [];

    /**
     * AbstractCommand constructor.
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param MessageListInterface $messages
     * @param array $arguments
     */
    public function __construct(IOHandlerInterface $ioHandler, UserSetInterface $users, MessageListInterface $messages, array $arguments)
    {
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
        $this->arguments = $arguments;
    }

    /**
     * Return an argument by its offset.
     * @param $offset
     * @return null
     */
    public function getArgument($offset)
    {
        if (isset($this->arguments[$offset])) {
            return $this->arguments[$offset];
        }
        return null;
    }

    /**
     * Find a user by its name. Throws an exception if the user does not exists.
     * @param string $userName
     * @return NULL|\TwitterBis\Entity\User
     */
    protected function getUserByName($userName)
    {
        if (!$user = $this->users->findByName($userName)) {
            throw new InvalidUserException(sprintf("The given user '%s' does not exists", $userName));
        }
        return $user;
    }

    /**
     * Run the command.
     * @return mixed
     */
    public abstract function run();
}