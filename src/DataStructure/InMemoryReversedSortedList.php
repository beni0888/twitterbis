<?php

namespace TwitterBis\DataStructure;

use TwitterBis\Entity\SortableItem;

class InMemoryReversedSortedList implements SortedListInterface
{
    /** @var SortableItem[] */
    private $items;
    /** @var int */
    private $position;

    /**
     * InMemorySortedList constructor.
     */
    public function __construct()
    {
        $this->items = [];
        $this->position = 0;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        --$this->position;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->position >= 0;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = count($this->items) - 1;
    }

    /**
     * Add a new item to the list.
     * @param SortableItem $item
     * @return $this
     */
    public function add(SortableItem $item)
    {

        $previousItem = $this->getLastItemInInternalList();
        $this->items[] = $item;
        /**
         * Con esto me aseguro de que los elementos se almacenan en el orden apropiado incluso aunque no lleguen en el
         * orden correcto. Esto podría ocurrir sólo si la aplicación fuese multithread o si corriese en un servidor web.
         * En el caso concreto no aplica pero considero apropiado tenerlo en cuenta.
         */
        if (!empty($previousItem) && $item->getOrderMagnitude() < $previousItem->getOrderMagnitude()) {
            usort($this->items, function(SortableItem $a, SortableItem $b) {
                if ($a->getOrderMagnitude() < $b->getOrderMagnitude()) {
                    return -1;
                } elseif ($a->getOrderMagnitude() == $b->getOrderMagnitude()) {
                    return 0;
                }
                return 1;
            });
        }
        return $this;
    }

    /**
     * Return the last item stored in the internal list, not the biggest one.
     */
    private function getLastItemInInternalList()
    {
        if (!$numItems = count($this->items)) {
            return null;
        }
        return $this->items[$numItems - 1];
    }
}