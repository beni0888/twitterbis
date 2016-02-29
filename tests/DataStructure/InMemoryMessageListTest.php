<?php

namespace DataStructure;

use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\SortedListInterface;
use TwitterBis\Entity\Message;
use TwitterBis\Entity\SortableItem;
use TwitterBis\Entity\User;

class InMemoryMessageListTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InMemoryMessageList */
    private $sut;

    protected function setUp()
    {
        $this->sut = new InMemoryMessageList(new SimpleSortedList());
    }

    /**
     * Create and return a User.
     * @return User
     */
    private function getUser()
    {
        return new User('foo-user', new InMemoryUserSet());
    }

    /**
     * @return \DateTime
     */
    private function getCurrentTime()
    {
        return new \DateTime('now', new \DateTimeZone('Europe/Madrid'));
    }

    public function testAddMessageWorksProperly()
    {
        $message = new Message('Foo', $this->getCurrentTime(), $this->getUser());
        $this->sut->add($message);

        $messagesInList = [];
        foreach ($this->sut as $msg) {
            $messagesInList[] = $msg;
        }

        $this->assertCount(1, $messagesInList, 'Number of messages in list is not the expected one');
        $this->assertEquals($message, $messagesInList[0], 'The gotten message from list is not the expected one');
    }

    public function testNextWorksProperly()
    {
        $user = $this->getUser();
        $messages[] = new Message('Foo', $this->getCurrentTime(), $user);
        $messages[] = new Message('Bar', $this->getCurrentTime(), $user);
        $messages[] = new Message('Foo Bar', $this->getCurrentTime(), $user);
        foreach ($messages as $message) {
            $this->sut->add($message);
        }

        $messagesInList = [];
        while ($msg = $this->sut->next()) {
            $messagesInList[] = $msg;
        }

        $this->assertEquals($messages, $messagesInList, 'Messages from list have not been traversed in the right order');
    }

    public function testGetIteratorReturnAnIterator()
    {
        $this->assertInstanceOf('\\Iterator', $this->sut->getIterator(), 'Returned object is not an Iterator');
    }
}

class SimpleSortedList implements SortedListInterface
{
    /** @var  \ArrayIterator */
    private $items;

    /**
     * SimpleSortedList constructor.
     */
    public function __construct()
    {
        $this->items = new \ArrayIterator();
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->items->current();
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->items->next();
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->items->key();
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->items->valid();
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->items->rewind();
    }

    /**
     * Add a new item to the list.
     * @param SortableItem $item
     */
    public function add(SortableItem $item)
    {
        $this->items->append($item);
    }
}
