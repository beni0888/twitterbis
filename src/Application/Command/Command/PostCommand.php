<?php

namespace TwitterBis\Application\Command\Command;

use DateTime;
use DateTimeZone;
use TwitterBis\Entity\Message;
use TwitterBis\Entity\User;

class PostCommand extends AbstractCommand
{
    const NAME = 'POST';
    const USER_ARGUMENT_OFFSET = 0;
    const MESSAGE_ARGUMENT_OFFSET = 1;

    /**
     * Return the name of the user passed to the command as argument.
     *
     * @return string
     */
    private function getUserName()
    {
        return $this->getArgument(self::USER_ARGUMENT_OFFSET);
    }

    /**
     * Return the message text passed to the command as argument.
     *
     * @return null
     */
    private function getMessageText()
    {
        return $this->getArgument(self::MESSAGE_ARGUMENT_OFFSET);
    }

    /**
     * Return the current time.
     *
     * @return DateTime
     */
    private function getCurrentTime()
    {
        return new DateTime('now', new DateTimeZone('Europe/Madrid'));
    }

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getUserName());
        $text = $this->getMessageText();
        $this->publishMessage($user, $text, $this->getCurrentTime());
    }

    /**
     * Publish a message.
     * @param User $user
     * @param $text
     * @param DateTime $timestamp
     */
    private function publishMessage(User $user, $text, DateTime $timestamp)
    {
        $this->messages->add(new Message($text, $timestamp, $user));
    }
}