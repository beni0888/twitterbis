<?php

namespace TwitterBis\Entity;

use TwitterBis\DataStructure\MessageListInterface;
use TwitterBis\DataStructure\UserSetInterface;

class UserRanking
{
    /** @var UserSetInterface */
    private $users;
    /** @var  MessageListInterface */
    private $messages;

    /**
     * UserRanking constructor.
     * @param UserSetInterface $users
     * @param MessageListInterface $messages
     */
    public function __construct(UserSetInterface $users, MessageListInterface $messages)
    {
        $this->users = $users;
        $this->messages = $messages;
    }

    /**
     * Return a list with users and number of messages.
     * @return array
     */
    private function getUserMessagesCountList()
    {
        $list = [];
        /** @var Message $message */
        foreach ($this->messages as $message) {
            if (!isset($list[$message->getAuthor()->getName()])) {
                $list[$message->getAuthor()->getName()] = 1;
            } else {
                $list[$message->getAuthor()->getName()] ++;
            }
        }

        /** @var User $user */
        foreach ($this->users as $user) {
            if (!isset($list[$user->getName()])) {
                $list[$user->getName()] = 0;
            }
        }
        return $list;
    }

    /**
     * Sort the given list descending.
     * @param array $list
     */
    private function sortUserMessagesCountListDescending(array &$list)
    {
        arsort($list, SORT_NUMERIC);
    }

    /**
     * Return the ranking of users that have published more messages.
     * @return array
     */
    public function getRanking()
    {
        $ranking = $this->getUserMessagesCountList();
        $this->sortUserMessagesCountListDescending($ranking);
        return $ranking;
    }

}