<?php

namespace Application\Command\Builder;

use TwitterBis\Application\Command\Builder\ReadCommandBuilder;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\IO\StandardIOHandler;

class ReadCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ReadCommandBuilder */
    private $sut;

    protected function setUp()
    {
        $this->sut = new ReadCommandBuilder(new StandardIOHandler(), new InMemoryUserSet(), new InMemoryMessageList(new InMemoryReversedSortedList()));
    }

    public function testBuildReturnBotCommandInstanceWhenMatchCommand()
    {
        $this->assertInstanceOf(
            'TwitterBis\Application\Command\Command\ReadCommand',
            $this->sut->build('foo'),
            'Build should return an instance of "ReadCommand"'
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
