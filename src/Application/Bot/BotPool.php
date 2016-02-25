<?php

namespace TwitterBis\Application\Bot;


use TwitterBis\DataStructure\SortedListInterface;
use TwitterBis\DataStructure\UserSetInterface;
use TwitterBis\Entity\User;
use TwitterBis\Exception\InvalidBotException;
use TwitterBis\IO\IOHandlerInterface;

/**
 * Implementando la instanciación de los bots de este modo respetamos el principio Open-Closed y permitimos añadir
 * nueva funcionalidad sin modificar la existente.
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
     * Find and return an instance of a boot.
     * @param $botName
     * @return mixed
     */
    public function findBot($botName)
    {
        foreach (glob(__DIR__ . "/*Bot.php") as $filename)
        {
            if ($filename === 'AbstractBot.php') {
                continue;
            }

            $className = substr($filename, 0, -strlen('.php'));
            if ($className instanceof AbstractBot) {
                $bot = new $className($this->user, $this->ioHandler, $this->users, $this->messages);
                if ($bot->getName() === $botName) {
                    return $bot;
                }
            }
        }

        throw new InvalidBotException(sprintf('Given bot "%s" in invalid', $botName));
    }
}