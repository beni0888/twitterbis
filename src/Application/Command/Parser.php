<?php

namespace TwitterBis\Application\Command;


use TwitterBis\Exception\InvalidCommandException;

class Parser
{
    private $ioHandler;
    private $users;
    private $messages;

    /**
     * Parser constructor.
     * @param $ioHandler
     * @param $users
     * @param $messages
     */
    public function __construct($ioHandler, $users, $messages)
    {
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
    }

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