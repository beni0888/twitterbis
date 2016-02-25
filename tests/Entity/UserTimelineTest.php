<?php

namespace Entity;


use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\Entity\Message;
use TwitterBis\Entity\User;
use TwitterBis\Entity\UserTimeline;

class UserTimelineTest extends \PHPUnit_Framework_TestCase
{
    /** @var  UserTimeline */
    private $sut;

    public function testUserTimelineShowsProperMessages()
    {
        $messages = new InMemoryMessageList(new InMemoryReversedSortedList());
        $userOne = new User('user-one', new InMemoryUserSet());
        $userTwo = new User('user-two', new InMemoryUserSet());
        $messages->add($msg1 = new Message('foo', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userOne));
        $messages->add($msg2 = new Message('bar', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userTwo));
        $messages->add($msg3 = new Message('foo bar', new \DateTime('now', new \DateTimeZone('Europe/Madrid')), $userOne));

        $this->sut = new UserTimeline($messages, $userOne);
        $iteratedMessages = [];
        foreach ($this->sut as $msg) {
            $iteratedMessages[] = $msg;
        }

        $this->assertEquals([$msg3, $msg1], $iteratedMessages, 'UserWall does not contain the proper messages');
    }


}
