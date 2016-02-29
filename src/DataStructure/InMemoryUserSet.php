<?php

namespace TwitterBis\DataStructure;


use Traversable;
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
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->set);
    }
}