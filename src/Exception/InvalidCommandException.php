<?php

namespace TwitterBis\Exception;

class InvalidCommandException extends InvalidArgumentException
{
    /**
     * Create an instance of the exception class and format the exception message properly for an "unknown command error
     * occurrence".
     * @param string $commandString
     * @return static
     */
    public static function unknownCommand($commandString)
    {
        return new static(sprintf('Invalid command: the given command "%s" does not exit', $commandString));
    }
}