<?php

namespace TwitterBis\Exception;

class InvalidBotException extends InvalidArgumentException
{
    /**
     * Create an instance of the exception class and format the exception message properly for an "unknown bot error
     * occurrence".
     * @param string $botName
     * @return static
     */
    public static function unknownBot($botName)
    {
        return new static(sprintf('Invalid Bot: Given bot "#%s" does not exit', $botName));
    }
}