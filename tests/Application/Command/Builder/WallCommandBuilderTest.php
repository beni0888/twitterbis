<?php

namespace Application\Command\Builder;

use TwitterBis\Application\Command\Builder\WallCommandBuilder;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\IO\StandardIOHandler;

class WallCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  WallCommandBuilder */
    private $sut;

    protected function setUp()
    {
        $this->sut = new WallCommandBuilder(new StandardIOHandler(), new InMemoryUserSet(), new InMemoryMessageList(new InMemoryReversedSortedList()));
    }

    public function testBuildReturnBotCommandInstanceWhenMatchCommand()
    {
        $this->assertInstanceOf(
            'TwitterBis\Application\Command\Command\WallCommand',
            $this->sut->build('foo wall'),
            'Build should return an instance of "WallCommand"'
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
