<?php

namespace TwitterBis\Entity;

interface SortableItem
{

    /**
     * Return the order magnitude of the item.
     * @return mixed
     */
    public function getOrderMagnitude();
}