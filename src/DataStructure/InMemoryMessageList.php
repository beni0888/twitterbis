<?php

namespace TwitterBis\DataStructure;

use Traversable;
use TwitterBis\Entity\Message;

class InMemoryMessageList implements MessageListInterface
{
    /** @var MessageListInterface */
    private $messageList;

    /**
     * NewInMemoryMessageList constructor.
     * @param SortedListInterface $messageList
     */
    public function __construct(SortedListInterface $messageList)
    {
        $this->messageList = $messageList;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return $this->messageList;
    }

    /**
     * Add a message to the list.
     * @param Message $message
     * @return MessageListInterface
     */
    public function add(Message $message)
    {
        $this->messageList->add($message);
        return $this;
    }

    /**
     * Return the next message from the list.
     * @return Message|NULL
     */
    public function next()
    {
        if (!$this->messageList->valid()) {
            return null;
        }
        $message = $this->messageList->current();
        $this->messageList->next();
        return $message;
    }
}