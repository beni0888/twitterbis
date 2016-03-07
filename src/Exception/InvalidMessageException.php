<?php

namespace TwitterBis\Exception;

class InvalidMessageException extends InvalidArgumentException
{
    /**
     * Create an instance of the exception class and format the exception message properly for an "empty message error
     * occurrence".
     * @return static
     */
    public static function emptyMessage()
    {
        return new static('Invalid message: empty messages are not allowed');
    }

    /**
     * Create an instance of the exception class and format the exception message properly for a "max message length
     * exceeded error occurrence".
     * @param int $maxLength
     * @param int $messageLength
     * @return static
     */
    public static function tooLong($maxLength, $messageLength)
    {
        return new static('Invalid message: max message length (%d) exceeded: %d', $maxLength, $messageLength);
    }
}