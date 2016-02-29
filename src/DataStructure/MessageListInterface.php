<?php

namespace TwitterBis\DataStructure;

use TwitterBis\Entity\Message;

interface MessageListInterface extends \IteratorAggregate
{
    /**
     * MessageListInterface constructor.
     * @param SortedListInterface $messageList
     */
    public function __construct(SortedListInterface $messageList);

    /**
     * Add a message to the list.
     * @param Message $message
     * @return MessageListInterface
     */
    public function add(Message $message);

    /**
     * Return the next message from the list.
     * @return Message|NULL
     */
    public function next();
}