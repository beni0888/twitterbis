<?php

namespace TwitterBis\Application\Command;

use TwitterBis\Entity\UserWall;
use TwitterBis\Formatter\MessageTimeFormatter;

class WallCommand extends AbstractCommand
{
    const NAME = 'WALL';
    const USER_ARGUMENT_OFFSET = 0;

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getArgument(self::USER_ARGUMENT_OFFSET));
        $userWall = new UserWall($this->messages, $user);
        $timeFormatter = new MessageTimeFormatter();

        /** @var Message $message */
        foreach ($userWall as $message) {
            $time = $timeFormatter->format($message->getTimestamp());
            $this->ioHandler->writeLine(sprintf('%s: %s %s', $message->getAuthor(), $message->getText(), !empty($time) ? "- ($time)" : ''));
        }
    }
}