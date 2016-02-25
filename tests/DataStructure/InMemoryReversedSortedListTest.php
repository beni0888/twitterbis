<?php

namespace TwitterBis\DataStructure;


use TwitterBis\Entity\SortableItem;

class InMemoryReversedSortedListTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InMemoryReversedSortedList */
    private $sut;

    protected function setUp()
    {
        $this->sut = new InMemoryReversedSortedList();
    }

    public function testIteratorInterfaceIsProperlyImplemented()
    {
        $result = [];
        foreach ($this->sut as $item) {
            $result[] = $item;
        }
        $this->assertEmpty($result, 'Resulting array should be empty');
    }

    public function testItemsAreStoredProperlySorted()
    {
        $this->sut->add(new Number(1));
        $this->sut->add(new Number(3));
        $this->sut->add(new Number(2));

        $expected = [
            new Number(1),
            new Number(2),
            new Number(3),
        ];
        $this->assertAttributeEquals($expected, 'items', $this->sut, 'Numbers are not sorted in high-low order');
    }

    public function testItemsAreIteratedInTheProperOrder()
    {
        $this->sut->add(new Number(1));
        $this->sut->add(new Number(3));
        $this->sut->add(new Number(2));

        $result = [];
        /** @var Number $number */
        foreach ($this->sut as $number) {
            $result[] = $number->getValue();
        }

        $this->assertEquals([3, 2, 1], $result, 'Numbers have not been iterated in high-low order');
    }

}

class Number implements SortableItem
{
    private $value;

    /**
     * Number constructor.
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return the value of the number
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return the order magnitude of the item.
     * @return mixed
     */
    public function getOrderMagnitude()
    {
        return $this->value;
    }
}