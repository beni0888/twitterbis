<?php

namespace TwitterBis\Application\Command\Builder;

class CommandBuilderWithInvalidName extends AbstractCommandBuilder
{

    /**
     * Return the regex to check if a string matches the current command.
     *
     * @return string
     */
    protected function getMatcher()
    {
        return '';
    }

    /**
     * Return the associated command class.
     *
     * @return string
     */
    protected function getCommandClass()
    {
        return '';
    }
}