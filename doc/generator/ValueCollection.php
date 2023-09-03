<?php

class ValueCollection implements IteratorAggregate
{
  private $items = [];

  /**
   * @param $item
   * @return $this
   */
  public function addValue($item)
  {
    $this->items[] = $item;
    return $this;
  }

  public function getIterator(): Traversable
  {
    foreach ($this->items as $item)
      yield $item;
  }
}

// initializes a collection
$col = new ValueCollection();
$col->addValue('A String')
  ->addValue(new stdClass())
  ->addValue(NULL);

foreach ($col as $item) {
  var_dump($item);
}