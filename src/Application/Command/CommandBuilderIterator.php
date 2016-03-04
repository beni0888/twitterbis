<?php

namespace TwitterBis\Application\Command;

use FilterIterator;
use DirectoryIterator;

class CommandBuilderIterator extends FilterIterator
{
    const COMMAND_BUILDER_NAMESPACE = '\TwitterBis\Application\Command\Builder';
    const COMMAND_BUILDER_BASE_CLASS = self::COMMAND_BUILDER_NAMESPACE . '\AbstractCommandBuilder';
    const COMMAND_BUILDER_NAME_PATTERN = '/CommandBuilder\.php$/';
    const PHP_FILE_EXTENSION = '.php';

    /**
     * CommandIterator constructor.
     * @param DirectoryIterator $iterator
     */
    public function __construct(DirectoryIterator $iterator)
    {
        parent::__construct($iterator);
    }

    /**
     * Check if the given baseName matches the pattern required for command builder names.
     *
     * @param string $baseName
     * @return bool
     */
    private function matchesNamePattern($baseName)
    {
        return preg_match(self::COMMAND_BUILDER_NAME_PATTERN, $baseName) === 1;
    }

    /**
     * Check if the given class name is a subclass of the required base class for commands.
     *
     * @param string $className
     * @return bool
     */
    private function matchesBaseClass($className)
    {
        $fullQualifiedClassName = self::COMMAND_BUILDER_NAMESPACE . '\\' . $className;
        return is_subclass_of($fullQualifiedClassName, self::COMMAND_BUILDER_BASE_CLASS);
    }

    /**
     * Check whether the current element of the iterator is acceptable
     * @link http://php.net/manual/en/filteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     * @since 5.1.0
     */
    public function accept()
    {
        /** @var DirectoryIterator $currentItem */
        $currentItem = $this->current();
        return $currentItem->isFile() &&
            $this->matchesNamePattern($currentItem->getBasename()) &&
            $this->matchesBaseClass($currentItem->getBasename(self::PHP_FILE_EXTENSION));
    }
}