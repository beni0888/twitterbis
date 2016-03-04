<?php

namespace Application\Command\Builder;

use TwitterBis\Application\Command\Builder\FollowCommandBuilder;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\IO\StandardIOHandler;

class FollowCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  FollowCommandBuilder */
    private $sut;

    protected function setUp()
    {
        $this->sut = new FollowCommandBuilder(new StandardIOHandler(), new InMemoryUserSet(), new InMemoryMessageList(new InMemoryReversedSortedList()));
    }

    public function testBuildReturnBotCommandInstanceWhenMatchCommand()
    {
        $this->assertInstanceOf(
            'TwitterBis\Application\Command\Command\FollowCommand',
            $this->sut->build('foo follows bar'),
            'Build should return an instance of "FollowCommand"'
        );
    }

    public function testBuildReturnNullWhenNotMatchCommand()
    {
        $this->assertNull(
            $this->sut->build('whatever foo bar'),
            'Build should return NULL'
        );
    }
}
