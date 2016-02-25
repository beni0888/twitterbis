<?php

namespace TwitterBis\IO;


class StandardIOHandler implements IOHandlerInterface
{

    /**
     * Read a line from the input.
     * @return string
     */
    public function readLine()
    {
        return fgets(STDIN);
    }

    /**
     * Write a line to the output.
     * @param string $line
     * @return void
     */
    public function writeLine($line)
    {
        fwrite(STDOUT, $line . PHP_EOL);
    }
}