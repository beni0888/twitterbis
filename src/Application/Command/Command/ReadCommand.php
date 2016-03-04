<?php

namespace TwitterBis\Application\Command\Command;

use TwitterBis\Entity\Message;
use TwitterBis\Entity\UserTimeline;
use TwitterBis\Formatter\MessageTimeFormatter;

class ReadCommand extends AbstractCommand
{
    const NAME = 'READ';
    const USER_ARGUMENT_OFFSET = 0;

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getArgument(self::USER_ARGUMENT_OFFSET));
        $userTimeline = new UserTimeline(new \IteratorIterator($this->messages), $user);
        $timeFormatter = new MessageTimeFormatter();

        /** @var Message $message */
        foreach ($userTimeline as $message) {
            $time = $timeFormatter->format($message->getTimestamp());
            $this->ioHandler->writeLine(sprintf('%s %s', $message->getText(), !empty($time) ? "- ($time)" : ''));
        }
    }

    /**
     * Return the regex to match the current command.
     *
     * @return string
     */
    public static function getMatcher()
    {
        return '/^([^\s]+) -> (.+)$/u';
    }
}