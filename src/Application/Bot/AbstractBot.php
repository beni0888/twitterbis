<?php

namespace TwitterBis\Application\Bot;

use TwitterBis\DataStructure\SortedListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Entity\User;
use TwitterBis\IO\IOHandlerInterface;

abstract class AbstractBot
{
    /** @var User */
    protected $user;
    /** @var  IOHandlerInterface */
    protected $ioHandler;
    /** @var  UserSetInterface */
    protected $users;
    /** @var  SortedListInterface */
    protected $messages;

    /**
     * AbstractCommand constructor.
     * @param User $user
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param SortedListInterface $messages
     */
    public function __construct(
        User $user,
        IOHandlerInterface $ioHandler,
        UserSetInterface $users,
        SortedListInterface $messages
    ) {
        $this->user = $user;
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
    }

    /**
     * Return the command name.
     * @return string
     */
    abstract public function getName();

    /**
     * Run the bot.
     * @return string
     */
    abstract public function run();
}