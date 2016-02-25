<?php

namespace TwitterBis\DataStructure;


use TwitterBis\Entity\User;

class InMemoryUserSet implements UserSetInterface
{
    /** @var  User[] */
    private $set;

    /**
     * InMemoryUserSet constructor.
     */
    public function __construct()
    {
        $this->set = [];
    }

    /**
     * Add a user
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        if (!isset($this->set[$user->getName()])) {
            $this->set[$user->getName()] = $user;
        }
    }

    /**
     * Find a user by its name.
     * @param $userName
     * @return User|NULL
     */
    public function findByName($userName)
    {
        if (isset($this->set[$userName])) {
            return $this->set[$userName];
        }
        return NULL;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->set);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->set);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->set);
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
        return current($this->set) !== false;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->set);
    }
}