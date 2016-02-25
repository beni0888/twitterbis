<?php

namespace TwitterBis\Entity;

use Iterator;

class UserTimeline extends \FilterIterator
{
    private $user;

    public function __construct(Iterator $iterator, User $user)
    {
        parent::__construct($iterator);
        $this->user = $user;
    }

    /**
     * Check whether the current element of the iterator is acceptable
     * @link http://php.net/manual/en/filteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     * @since 5.1.0
     */
    public function accept()
    {
        /** @var Message $currentMessage */
        $currentMessage = $this->current();
        return $currentMessage->getAuthor() === $this->user;
    }
}