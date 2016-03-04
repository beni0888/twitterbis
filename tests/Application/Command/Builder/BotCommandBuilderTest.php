<?php

namespace Application\Command\Builder;

use TwitterBis\Application\Command\Builder\BotCommandBuilder;
use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\IO\StandardIOHandler;

class BotCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  BotCommandBuilder */
    private $sut;

    protected function setUp()
    {
        $this->sut = new BotCommandBuilder(new StandardIOHandler(), new InMemoryUserSet(), new InMemoryMessageList(new InMemoryReversedSortedList()));
    }

    public function testBuildReturnBotCommandInstanceWhenMatchCommand()
    {
        $this->assertInstanceOf(
            'TwitterBis\Application\Command\Command\BotCommand',
            $this->sut->build('foo #bar'),
            'Build should return an instance of "TwitterBis\Application\Command\Command\BotCommand"'
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
