<?php

namespace Entity;

use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\Entity\Message;
use TwitterBis\Entity\User;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Return a user instance.
     *
     * @param string $name
     * @return User
     */
    private function getUser($name)
    {
        return new User($name, new InMemoryUserSet());
    }

    /**
     * Return a DateTime object for the current time.
     *
     * @return \DateTime
     */
    private function getCurrentTime()
    {
        return new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * @expectedException TwitterBis\Exception\InvalidMessageException
     */
    public function testMessageWithEmptyTextThrowsException()
    {
        new Message('', $this->getCurrentTime(), $this->getUser('foo'));
    }

    /**
     * @expectedException TwitterBis\Exception\InvalidMessageException
     */
    public function testMessageWithTooLongTextThrowsException()
    {
        $text = str_repeat('a', Message::TEXT_MAX_LENGTH + 1);
        new Message($text, $this->getCurrentTime(), $this->getUser('foo'));
    }


}
