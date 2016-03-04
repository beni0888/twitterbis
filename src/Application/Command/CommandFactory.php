<?php

namespace TwitterBis\Application\Command;


use TwitterBis\Application\Command\Builder\AbstractCommandBuilder;
use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Exception\InvalidCommandException;
use TwitterBis\IO\IOHandlerInterface;

class CommandFactory
{
    /** @var string */
    private $builderDirectory;
    /** @var AbstractCommandBuilder[] */
    private $builderPool;
    /** @var IOHandlerInterface */
    private $ioHandler;
    /** @var UserSetInterface */
    private $users;
    /** @var MessageListInterface */
    private $messages;

    /**
     * CommandFactory constructor.
     * @param string $builderDirectory
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param MessageListInterface $messages
     */
    public function __construct($builderDirectory, IOHandlerInterface $ioHandler, UserSetInterface $users, MessageListInterface $messages)
    {
        $this->builderDirectory = $builderDirectory;
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;

        $this->loadCommandBuilders();
    }


    /**
     * Load all the available command builders into the $builderPool property.
     *
     * @return $this
     */
    private function loadCommandBuilders()
    {
        $this->builderPool = [];
        $builderIterator = new CommandBuilderIterator(new \DirectoryIterator($this->builderDirectory));
        foreach ($builderIterator as $builderFile) {
            $className = CommandBuilderIterator::COMMAND_BUILDER_NAMESPACE . '\\' . $builderFile->getBasename(CommandBuilderIterator::PHP_FILE_EXTENSION);
            $this->builderPool[] = new $className($this->ioHandler, $this->users, $this->messages);
        }
        return $this;
    }

    /**
     * Return the command that matches the given command string.
     *
     * @param $commandString
     * @return Command\AbstractCommand
     */
    public function getCommand($commandString)
    {
        /** @var AbstractCommandBuilder $builder */
        foreach ($this->builderPool as $builder) {
            if ($command = $builder->build($commandString)) {
                return $command;
            }
        }
        throw new InvalidCommandException(sprintf('Invalid command: "%s"', $commandString));
    }
}