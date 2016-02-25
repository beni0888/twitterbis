<?php

namespace TwitterBis\Application\Command;


class FollowCommand extends AbstractCommand
{
    const NAME = 'FOLLOW';
    const USER_ARGUMENT_OFFSET = 0;
    const FOLLOWED_USER_ARGUMENT_OFFSET = 1;

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $user = $this->getUserByName($this->getArgument(self::USER_ARGUMENT_OFFSET));
        $followedUser = $this->getUserByName($this->getArgument(self::FOLLOWED_USER_ARGUMENT_OFFSET));

        $user->followUser($followedUser);
    }
}