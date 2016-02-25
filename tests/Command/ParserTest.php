<?php

namespace TwitterBis\Application\Command;

use TwitterBis\DataStructure\InMemoryMessageList;
use TwitterBis\DataStructure\InMemoryReversedSortedList;
use TwitterBis\DataStructure\InMemoryUserSet;
use TwitterBis\IO\StandardIOHandler;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Parser */
    private $sut;

    protected function setUp()
    {
        $this->sut = new Parser(new StandardIOHandler(), new InMemoryUserSet(), new InMemoryMessageList(new InMemoryReversedSortedList()));
    }

    /**
     * @expectedException TwitterBis\Exception\InvalidCommandException
     */
    public function testAnExceptionIsThrownIfInvalidCommandIsGiven()
    {
        $this->sut->parse('whatever non existent command');
    }

    public function testPostCommandIsParsed()
    {
        $command = $this->sut->parse('foo -> bar');
        $this->assertInstanceOf('TwitterBis\Application\Command\PostCommand', $command, 'Parsed command is not an instance of PostCommand');
    }

    public function testReadCommandIsParsed()
    {
        $command = $this->sut->parse('foo');
        $this->assertInstanceOf('TwitterBis\Application\Command\ReadCommand', $command, 'Parsed command is not an instance of ReadCommand');
    }

    public function testFollowsCommandIsParsed()
    {
        $command = $this->sut->parse('foo follows bar');
        $this->assertInstanceOf('TwitterBis\Application\Command\FollowCommand', $command, 'Parsed command is not an instance of FollowCommand');
    }

    public function testWallCommandIsParsed()
    {
        $command = $this->sut->parse('foo wall');
        $this->assertInstanceOf('TwitterBis\Application\Command\WallCommand', $command, 'Parsed command is not an instance of WallCommand');
    }

    public function testBotCommandIsParsed()
    {
        $command = $this->sut->parse('foo #bar');
        $this->assertInstanceOf('TwitterBis\Application\Command\BotCommand', $command, 'Parsed command is not an instance of BotCommand');
    }

}