<?php

namespace Entity;

use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\Entity\Message;
use TwitterBis\Entity\User;
use TwitterBis\Entity\UserWall;

class UserWallTest extends \PHPUnit_Framework_TestCase
{
    /** @var  UserWall */
    private $sut;

    public function testUserTimelineShowsProperMessages()
    {
        $messages = new InMemoryMessageList(new InMemoryReversedSortedList());
        $userOne = new User('user-one', new InMemoryUserSet());
        $userTwo = new User('user-two', new InMemoryUserSet());
        $userThree = new User('user-three', new InMemoryUserSet());
        $messages->add($msg1 = new Message('foo', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userOne));
        $messages->add($msg2 = new Message('bar', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userTwo));
        $messages->add($msg3 = new Message('foo bar', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userOne));
        $messages->add($msg4 = new Message('foo bar baz', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userThree));

        $userOne->followUser($userThree);

        $this->sut = new UserWall(new \IteratorIterator($messages), $userOne);
        $iteratedMessages = [];
        foreach ($this->sut as $msg) {
            $iteratedMessages[] = $msg;
        }

        $this->assertEquals([$msg4, $msg3, $msg1], $iteratedMessages, 'UserWall does not contain the proper messages');
    }
}
