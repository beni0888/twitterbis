<?php

namespace TwitterBis\Application\Command\Command;

use TwitterBis\Entity\Message;
use TwitterBis\Entity\UserWall;
use TwitterBis\Formatter\MessageTimeFormatter;

class WallCommand extends AbstractCommand
{
    const NAME = 'WALL';
    const USER_ARGUMENT_OFFSET = 0;

    private $timeFormatter;

    private function compose(Message $message)
    {
        $timestamp = $message->getTimestamp();
        $time = $this->format($timestamp);
        $printPattern = '%s: %s %s';

        $composedMessage = sprintf($printPattern, $message->getAuthor(), $message->getText(), $time);
        return $composedMessage;
    }

    private function format($timestamp)
    {
        $formatter = $this->retrieveTimeFormatter();
        $time = $formatter->format($timestamp);
        return $this->normalize($time);
    }

    private function normalize($time)
    {
        $result = "- ($time)";
        if (empty($time)) $result = '';
        return $result;
    }

    private function write(Message $message)
    {
        $this->ioHandler->writeLine($this->compose($message));
    }

    private function retrieveTimeFormatter()
    {
        if (is_null($this->timeFormatter)) {
            $this->timeFormatter = new MessageTimeFormatter();
        }
        return $this->timeFormatter;
    }

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getArgument(self::USER_ARGUMENT_OFFSET));
        $userWall = new UserWall(new \IteratorIterator($this->messages), $user);

        /** @var Message $message */
        foreach ($userWall as $message) {
            $this->write($message);
        }
    }
}