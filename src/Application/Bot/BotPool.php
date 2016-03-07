<?php

namespace TwitterBis\Application\Bot;

use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Entity\User;
use TwitterBis\Exception\InvalidBotException;
use TwitterBis\IO\IOHandlerInterface;

/**
 * With this implementation we respect the Open-Closed SOLID principle. It allows us to add new bots without modifying
 * the already existing logic.
 *
 * Class BotPool
 * @package TwitterBis\Application\Bot
 */
class BotPool
{
    /** @var User */
    protected $user;
    /** @var  IOHandlerInterface */
    protected $ioHandler;
    /** @var  UserSetInterface */
    protected $users;
    /** @var  MessageListInterface */
    protected $messages;

    /**
     * AbstractCommand constructor.
     * @param User $user
     * @param IOHandlerInterface $ioHandler
     * @param UserSetInterface $users
     * @param MessageListInterface $messages
     */
    public function __construct(
        User $user,
        IOHandlerInterface $ioHandler,
        UserSetInterface $users,
        MessageListInterface $messages
    ) {
        $this->user = $user;
        $this->ioHandler = $ioHandler;
        $this->users = $users;
        $this->messages = $messages;
    }

    /**
     * Find and return an instance of a boot.
     * @param string $botName
     * @return AbstractBot
     * @throws InvalidBotException
     */
    public function findBot($botName)
    {
        $namespace = 'TwitterBis\\Application\\Bot\\';
        foreach (glob(__DIR__ . "/*Bot.php") as $filename)
        {
            $className = substr($filename, strrpos($filename, '/') + 1, -strlen('.php'));
            if ($className === 'AbstractBot') {
                continue;
            }

            $className = $namespace . $className;
            $bot = new $className($this->user, $this->ioHandler, $this->users, $this->messages);

            if (($bot instanceof AbstractBot) && ($bot->getName() === $botName)) {
                return $bot;
            }
        }

        throw InvalidBotException::unknownBot($botName);
    }
}