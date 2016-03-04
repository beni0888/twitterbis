<?php

namespace Application\Command\Builder;

use TwitterBis\Application\Command\Builder\PostCommandBuilder;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\IO\StandardIOHandler;

class PostCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PostCommandBuilder */
    private $sut;

    protected function setUp()
    {
        $this->sut = new PostCommandBuilder(new StandardIOHandler(), new InMemoryUserSet(), new InMemoryMessageList(new InMemoryReversedSortedList()));
    }

    public function testBuildReturnBotCommandInstanceWhenMatchCommand()
    {
        $this->assertInstanceOf(
            'TwitterBis\Application\Command\Command\PostCommand',
            $this->sut->build('foo -> bar'),
            'Build should return an instance of "PostCommand"'
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
