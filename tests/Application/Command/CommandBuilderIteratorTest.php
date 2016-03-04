<?php

namespace TwitterBis\Application\Command;

class CommandBuilderIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testCommandBuilderIteratorWorksProperly()
    {
        $sut = new CommandBuilderIterator(new \DirectoryIterator(__DIR__ . '/Builder/TestBuilders'));

        $commands = [];
        foreach ($sut as $command) {
            $commands[]= $command->getBasename();
        }

        $this->assertCount(2, $commands, 'The number of commands in the iterator is not the expected one');
        $this->assertContains('FooCommandBuilder.php', $commands, 'The expected command builder is not contained in the array of commands returned by the iterator');
        $this->assertContains('BarCommandBuilder.php', $commands, 'The expected command builder is not contained in the array of commands returned by the iterator');
    }
}
