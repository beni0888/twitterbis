<?php

namespace TwitterBis\Application\Command\Command;

class FooCommand extends AbstractCommand
{

    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $this->ioHandler->writeLine('Foo Command executed!!');
    }

    /**
     * Check if the current command matches the given order.
     *
     * @param string $command
     * @return bool
     */
    public function match($command)
    {
        return preg_match('/foo/', $command) === 1;
    }
}