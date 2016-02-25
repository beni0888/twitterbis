<?php

namespace TwitterBis\Application\Command;

use DateTime;
use DateTimeZone;
use TwitterBis\Entity\Message;
use TwitterBis\Entity\User;
use TwitterBis\Exception\InvalidMessageException;

class PostCommand extends AbstractCommand
{
    const NAME = 'POST';
    const USER_ARGUMENT_OFFSET = 0;
    const MESSAGE_ARGUMENT_OFFSET = 1;
    const MAX_TEXT_LENGTH = 140;

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getArgument(self::USER_ARGUMENT_OFFSET));
        $text = $this->getArgument(self::MESSAGE_ARGUMENT_OFFSET);
        $this->validateMessageText($text);
        $timestamp = new DateTime('now', new DateTimeZone('Europe/Madrid'));
        $this->publishMessage($user, $text, $timestamp);
    }

    /**
     * Validate the message text.
     * @param string $text
     */
    private function validateMessageText($text)
    {
        if (empty($text)) {
            throw new InvalidMessageException('Empty messages are not allowed');
        }
        if ($messageLength = mb_strlen($text, 'utf-8') > self::MAX_TEXT_LENGTH) {
            throw new InvalidMessageException(sprintf('Max message length (%d) exceeded: %d', self::MAX_TEXT_LENGTH, $messageLength));
        }
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