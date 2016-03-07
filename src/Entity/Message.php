<?php

namespace TwitterBis\Entity;

use DateTime;
use TwitterBis\Exception\InvalidMessageException;

class Message implements SortableItem
{
    const TEXT_MAX_LENGTH = 140;
    const TEXT_ENCODING = 'utf-8';

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
        $this->validateText($text);

        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->author = $author;
    }

    /**
     * Check that the given text does not violate any rule.
     *
     * @param $text
     */
    private function validateText($text)
    {
        $this->assertNotEmpty($text);
        $this->assertMaxLength($text);
    }

    /**
     * Assert that the given text is not empty.
     *
     * @param string $text
     * @throws InvalidMessageException
     */
    private function assertNotEmpty($text)
    {
        if (empty($text)) {
            throw InvalidMessageException::emptyMessage();
        }
    }

    /**
     * Assert that the given text does not exceed the text max length.
     *
     * @param string $text
     * @throws InvalidMessageException
     */
    private function assertMaxLength($text)
    {
        if (($messageLength = mb_strlen($text, self::TEXT_ENCODING)) > self::TEXT_MAX_LENGTH) {
            throw InvalidMessageException::tooLong(self::TEXT_MAX_LENGTH, $messageLength);
        }
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