<?php

class CacheGenerator
{
  protected array $cache = [];
  protected $generator = null;

  public function __construct($generator)
  {
    $this->generator = $generator;
  }

  public function generator(): Generator
  {
    foreach ($this->cache as $item) yield $item;

    while($this->generator->valid()) {
      $this->cache[] = $current = $this->generator->current();
      $this->generator->next();
      yield $current;
    }
  }
}

class Foobar {
  protected $loader = null;

  protected function loadItems(): Generator
  {
    foreach (range(0, 10) as $i) {
      usleep(200000);
      yield $i;
    }
  }

  public function getItems(): Generator
  {
    $this->loader = $this->loader ?: new CacheGenerator($this->loadItems());
    return $this->loader->generator();
  }
}

$f = new Foobar;

# First
print "First" . PHP_EOL;
foreach ($f->getItems() as $i) {
  print "$i ";
  if ($i === 5) break;
}

print PHP_EOL;

# Second (items 1-5 are cached, 6-10 are loaded)
print "Second" . PHP_EOL;
foreach ($f->getItems() as $i) {
  print "$i ";
}

print PHP_EOL;

# Third (all items are cached and returned instantly)
print "Third" . PHP_EOL;
foreach ($f->getItems() as $i) {
  print "$i ";
}

print PHP_EOL;
