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
    const BOT_NAMESPACE = 'TwitterBis\Application\Bot';

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
     *
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
     * Return an instance of the bot that matches the given bot name.
     *
     * @param string $botName
     * @return AbstractBot
     * @throws InvalidBotException
     */
    public function findBot($botName)
    {
        foreach (glob(__DIR__ . "/*Bot.php") as $filename)
        {
            $className = substr($filename, strrpos($filename, '/') + 1, -strlen('.php'));
            if ($className === 'AbstractBot') {
                continue;
            }

            $className = self::BOT_NAMESPACE . '\\' . $className;
            $bot = new $className($this->user, $this->ioHandler, $this->users, $this->messages);

            if (($bot instanceof AbstractBot) && ($bot->getName() === $botName)) {
                return $bot;
            }
        }

        throw InvalidBotException::unknownBot($botName);
    }
}