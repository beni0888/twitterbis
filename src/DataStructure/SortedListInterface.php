<?php

namespace TwitterBis\DataStructure;

use TwitterBis\Entity\SortableItem;

interface SortedListInterface extends \Iterator
{
    /**
     * Add a new item to the list.
     * @param SortableItem $item
     */
    public function add(SortableItem $item);
}