<?php

namespace TwitterBis\Application\Command;

use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Exception\InvalidCommandException;
use TwitterBis\IO\IOHandlerInterface;

class Parser
{
    /** @var IOHandlerInterface  */
    private $ioHandler;
    /** @var UserSetInterface  */
    private $users;
    /** @var MessageListInterface  */
    private $messages;

    /**
     * Parser constructor.
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param MessageListInterface $messages
     */
    public function __construct(IOHandlerInterface $ioHandler, UserSetInterface $users, MessageListInterface $messages)
    {
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
    }

    /**
     * Parse a string containing a command and return the parsed command.
     * @param string $line
     * @return BotCommand|FollowCommand|PostCommand|ReadCommand|WallCommand
     * @throws InvalidCommandException
     */
    public function parse($line)
    {
        if (preg_match('/^([^\s]+) -> (.+)$/u', $line, $arguments)) {
            $arguments = array_slice($arguments, 1);
            return new PostCommand($this->ioHandler, $this->users, $this->messages, $arguments);
        }

        if (preg_match('/^([^\s]+) follows ([^\s]+)$/u', $line, $arguments)) {
            $arguments = array_slice($arguments, 1);
            return new FollowCommand($this->ioHandler, $this->users, $this->messages, $arguments);
        }

        if (preg_match('/^([^\s]+) wall$/u', $line, $arguments)) {
            $arguments = array_slice($arguments, 1);
            return new WallCommand($this->ioHandler, $this->users, $this->messages, $arguments);
        }

        if (preg_match('/^([^\s]+) #(.+)$/u', $line, $arguments)) {
            $arguments = array_slice($arguments, 1);
            return new BotCommand($this->ioHandler, $this->users, $this->messages, $arguments);
        }

        if (preg_match('/^([^\s]+)$/u', $line, $arguments)) {
            $arguments = array_slice($arguments, 1);
            return new ReadCommand($this->ioHandler, $this->users, $this->messages, $arguments);
        }

        throw new InvalidCommandException(sprintf('Invalid command: "%s"', $line));
    }

}