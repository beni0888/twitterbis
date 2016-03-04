<?php

namespace TwitterBis\Application\Command\Command;

class BarCommand extends AbstractCommand
{
    /**
     * Run the command.
     * @return mixed
     */
    public function run()
    {
        $this->ioHandler->writeLine('Bar Command Executed!!');
    }

    /**
     * Check if the current command matches the given order.
     *
     * @param string $command
     * @return bool
     */
    public function match($command)
    {
        return preg_match('/bar/', $command) === 1;
    }
}