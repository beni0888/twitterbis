<?php

namespace TwitterBis\Application\Command;

use TwitterBis\Application\Bot\BotPool;

class BotCommand extends AbstractCommand
{
    const NAME = 'BOT';
    const USER_ARGUMENT_OFFSET = 0;
    const BOT_ARGUMENT_OFFSET = 1;

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getArgument(self::USER_ARGUMENT_OFFSET));
        $botName = $this->getArgument(self::BOT_ARGUMENT_OFFSET);

        $botPool = new BotPool($user, $this->ioHandler, $this->users, $this->messages);
        $bot = $botPool->findBot($botName);
        $bot->run();
    }
}