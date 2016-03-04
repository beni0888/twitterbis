<?php

namespace TwitterBis\Application\Command\Builder;

class FooCommandBuilder extends AbstractCommandBuilder
{

    /**
     * Return the regex to check if a string matches the current command.
     *
     * @return string
     */
    protected function getMatcher()
    {
        return '/^foo$/';
    }

    /**
     * Return the associated command class.
     *
     * @return string
     */
    protected function getCommandClass()
    {
        return '\\TwitterBis\\Application\\Command\\Command\\FooCommand';
    }
}