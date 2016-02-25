<?php

namespace TwitterBis\DataStructure;

use Iterator;
use TwitterBis\Entity\User;

interface UserSetInterface extends Iterator
{
    /**
     * Add a user
     * @param User $user
     * @return mixed
     */
    public function add(User $user);

    /**
     * Find a user by its name.
     * @param $userName
     * @return User|NULL
     */
    public function findByName($userName);
}