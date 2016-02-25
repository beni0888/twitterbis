<?php

namespace TwitterBis\IO;


interface IOHandlerInterface
{
    /**
     * Read a line from the input.
     * @return string
     */
    public function readLine();

    /**
     * Write a line to the output.
     * @param string $line
     * @return void
     */
    public function writeLine($line);
}