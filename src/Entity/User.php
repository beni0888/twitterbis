<?php

namespace TwitterBis\Entity;


use TwitterBis\DataStructure\UserSetInterface;

class User
{
    /** @var  string */
    private $name;
    /** @var  UserSetInterface */
    private $followedUsers;

    /**
     * User constructor.
     * @param $name
     * @param UserSetInterface $followedUsers
     */
    public function __construct($name, UserSetInterface $followedUsers)
    {
        $this->name = $name;
        $this->followedUsers = $followedUsers;
    }

    /**
     * Return the name of the user.
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the set of followed users.
     * @return UserSetInterface
     */
    public function getFollowedUsers()
    {
        return $this->followedUsers;
    }

    /**
     * Add a user into the current user's followed users list;
     * @param User $user
     * @return $this
     */
    public function followUser(User $user)
    {
        $this->followedUsers->add($user);
        return $this;
    }

    /**
     * Return a string representation of the user.
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }
}