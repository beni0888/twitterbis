<?php

namespace TwitterBis\IO;


class TextFileIOHandler implements IOHandlerInterface
{
    private $inputFile;
    private $outputFile;

    /**
     * TextFileIOHandler constructor.
     * @param string $inputFilePath
     * @param string $outputFilePath
     */
    public function __construct($inputFilePath, $outputFilePath)
    {
        if (!$this->inputFile = fopen($inputFilePath, 'r')) {
            throw new \RuntimeException('Unable to open file for reading operation: ' . $inputFilePath);
        }
        if (!$this->outputFile = fopen($outputFilePath, 'w')) {
            throw new \RuntimeException('Unable to open file for writing operation: ' . $outputFilePath);
        }
    }

    function __destruct()
    {
        if ($this->inputFile) {
            fclose($this->inputFile);
        }

        if ($this->outputFile) {
            fclose($this->outputFile);
        }
    }


    /**
     * @inheritDoc
     */
    public function readLine()
    {
        return fgets($this->inputFile);
    }

    /**
     * @inheritDoc
     */
    public function writeLine($line)
    {
        return fputs($this->outputFile, $line . PHP_EOL);
    }
}