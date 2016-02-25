<?php

namespace TwitterBis\Entity;

use DateTime;

class Message implements SortableItem
{
    /** @var  string */
    private $text;
    /** @var DateTime */
    private $timestamp;
    /** @var User */
    private $author;

    /**
     * Message constructor.
     * @param $text
     * @param DateTime $timestamp
     * @param User $author
     */
    public function __construct($text, DateTime $timestamp, User $author)
    {
        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->author = $author;
    }

    /**
     * Return the text of the message.
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Return the author of the message.
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Return the timestamp of the message
     * @return DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Return the order magnitude of the item.
     * @return mixed
     */
    public function getOrderMagnitude()
    {
        return $this->getTimestamp();
    }

    /**
     * Return a string representation of the message.
     */
    function __toString()
    {
        return sprintf('%s - %s - %s', $this->author->getName(), $this->text, $this->timestamp->format('H:i:s'));
    }


}