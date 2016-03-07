<?php

namespace TwitterBis\Exception;

class InvalidUserException extends InvalidArgumentException
{
    /**
     * Create an instance of the exception class and format the exception message properly for an "unknown user error
     * occurrence".
     * @param string $userName
     * @return static
     */
    public static function unknownUser($userName)
    {
        return new static(sprintf('Invalid user: The given user "%s" does not exist', $userName));
    }
}