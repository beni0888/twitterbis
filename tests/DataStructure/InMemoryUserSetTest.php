<?php

namespace DataStructure;

use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\Entity\User;

class InMemoryUserSetTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InMemoryUserSet */
    private $sut;

    protected function setUp()
    {
        $this->sut = new InMemoryUserSet();
    }

    public function testAddAddsAUserToTheSet()
    {
        $user = new User('foo', new InMemoryUserSet());
        $this->sut->add($user);
        $usersInSet = [];
        foreach ($this->sut as $userInSet) {
            $usersInSet[] = $userInSet;
        }
        $this->assertCount(1, $usersInSet, 'The number of users in the set does not match the expected one');
        $this->assertEquals([$user], $usersInSet, 'Users in the set are not the expected ones');
    }

    public function testUsersInSetAreStoredOnlyOnce()
    {
        $user1 = new User('foo', new InMemoryUserSet());
        $user2 = new User('bar', new InMemoryUserSet());
        $this->sut->add($user1);
        $this->sut->add($user2);
        $this->sut->add($user1);

        $this->assertCount(2, $this->sut->getIterator(), 'The number of users in the set does not match the expected one');
        $this->assertEquals(['foo' => $user1, 'bar' => $user2], iterator_to_array($this->sut->getIterator()), 'Users in the set are not the expected ones');
    }

    public function testUsersCanBeFoundByName()
    {
        $this->sut->add($user1 = new User('foo', new InMemoryUserSet()));
        $this->sut->add(new User('bar', new InMemoryUserSet()));
        $this->sut->add(new User('foobar', new InMemoryUserSet()));

        $this->assertSame($user1, $this->sut->findByName('foo'), 'The found user does not match the expected one');
    }

    public function testUserSetIsProperlyTraversed()
    {
        $this->sut->add($user1 = new User('foo', new InMemoryUserSet()));
        $this->sut->add($user2 = new User('bar', new InMemoryUserSet()));
        $this->sut->add($user3 = new User('foobar', new InMemoryUserSet()));

        $usersInSet = [];
        foreach ($this->sut as $key => $value) {
            $usersInSet[$key] = $value;
        }

        $expectedUsersInSet = ['foo' => $user1, 'bar' => $user2, 'foobar' => $user3];
        $this->assertEquals($expectedUsersInSet, $usersInSet, 'Users in the set are not the expected ones');
    }
}
