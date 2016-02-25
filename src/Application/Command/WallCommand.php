<?php

namespace TwitterBis\Application\Command;

use TwitterBis\Entity\UserWall;

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

        /** @var Message $message */
        foreach ($userWall as $message) {
            $this->ioHandler->writeLine(sprintf('%s - %s', $message->getText(), $message->getTimestamp()->format('H:i:s')));
        }
    }
}