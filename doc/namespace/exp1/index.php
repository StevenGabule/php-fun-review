<?php

namespace fub;
include 'foo.php';
include 'bar.php';
include 'animate.php';

use foo as feline;
use bar as canine;
use animate;

print feline\Cat::says() . PHP_EOL;
print canine\Dog::says() . PHP_EOL;
print animate\Animate::breathes() . PHP_EOL;

function getTotal($product_cost, $tax): float
{
  $total = 0.0;
  $callback = function ($pricePerItem) use ($tax, &$total) {
    $total += $pricePerItem * ($tax + 1.0);
  };
  array_walk($product_cost, $callback);
  return round($total, 2);
}

