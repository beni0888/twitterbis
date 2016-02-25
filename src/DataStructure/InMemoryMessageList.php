<?php

namespace TwitterBis\DataStructure;

use TwitterBis\Entity\SortableItem;

class InMemoryMessageList implements SortedListInterface
{
    /** @var SortedListInterface */
    private $messages;

    /**
     * InMemoryMessageList constructor.
     * @param SortedListInterface $messages
     */
    public function __construct(SortedListInterface $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Add a new message to the list.
     * @param $message
     * @return $this
     */
    public function add(SortableItem $message)
    {
        $this->messages->add($message);
        return $this;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->messages->current();
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->messages->next();
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->messages->key();
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
        return $this->messages->valid();
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->messages->rewind();
    }
}