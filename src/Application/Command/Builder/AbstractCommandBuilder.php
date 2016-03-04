<?php

namespace TwitterBis\Application\Command\Builder;

use TwitterBis\Application\Command\Command\AbstractCommand;
use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\IO\IOHandlerInterface;

abstract class AbstractCommandBuilder
{
    const FULL_COMMAND_MATCH_OFFSET = 0;

    /** @var  IOHandlerInterface */
    protected $ioHandler;
    /** @var UserSetInterface  */
    protected $users;
    /** @var MessageListInterface  */
    protected $messages;

    /**
     * AbstractCommandBuilder constructor.
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
     * Return an array with the arguments passed to the command in the call.
     *
     * @param array $arrayOfMatches
     * @return array
     */
    final protected function getCommandArguments(array $arrayOfMatches)
    {
        if (!empty($arrayOfMatches)) {
            unset($arrayOfMatches[self::FULL_COMMAND_MATCH_OFFSET]);
        }
        return array_values($arrayOfMatches);
    }

    /**
     * Create and return and instance of the associated command.
     *
     * @param string $command
     * @return AbstractCommand|NULL
     */
    /**
     * Create and return and instance of the associated command.
     *
     * @param string $command
     * @return AbstractCommand
     */
    final public function build($command)
    {
        if (preg_match($this->getMatcher(), $command, $matches) !== 1) {
            return null;
        }

        $arguments = $this->getCommandArguments($matches);
        $commandClass = $this->getCommandClass();
        return new $commandClass($this->ioHandler, $this->users, $this->messages, $arguments);
    }

    /**
     * Return the regex to check if a string matches the current command.
     *
     * @return string
     */
    protected abstract function getMatcher();

    /**
     * Return the associated command class.
     *
     * @return string
     */
    protected abstract function getCommandClass();
}