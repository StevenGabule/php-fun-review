<?php
function add_3_by_ref(&$value): void
{
  $value += 3;
  print "Number: $value" . PHP_EOL;
}

$num = 5;
add_3_by_ref($num);
print "Number: {$num}" . PHP_EOL;

// How to modify a string that's passed by reference
function wrap_in_tag(&$text, $tag): void
{
  $before = "<$tag>";
  $after = "</$tag>";
  $text = "{$before}{$text}{$after}";
}

$msg = 'Value out of range.';
wrap_in_tag($msg, 'p');
print $msg . PHP_EOL;

// how to return multiple values
function array_analyze($array, &$sum, &$prod, &$avg): void
{
  $sum = array_sum($array);
  $prod = array_product($array);
  $avg = $sum / count($array);
}

$list = [1, 4, 9, 16];
array_analyze($list, $s, $p, $a);
print "Sum: {$s}\nProduct: {$p}\nAverage: {$a}" . PHP_EOL;


function get_rand_bool_text($type = 'coin'): string
{
  $rand = mt_rand(0, 1);
  $result = '';
  switch ($type) {
    case 'coin':
      $result = ($rand == 1) ? 'heads' : 'tails';
      break;
    case 'switch':
      $result = ($rand == 1) ? 'on' : 'off';
      break;
  }
  return $result;
}

// three functions for working with variable-length parameter lists
// 1. func_get_args(), 2. func_num_args, 3. func_get_arg($i)
# How to write a function with variable parameter list
function add(): float
{
  $numbers = func_get_args();
  $total = 0;
  foreach ($numbers as $number) {
    $total += $number;
  }
  return $total;
}

print add(1, 5, 10, 3.5) . PHP_EOL;

# A function that averages one or more numbers
function average($x): float
{
  $count = func_num_args();
  $total = 0;
  for ($i = 0; $i < $count; $i++) {
    $total += func_get_arg($i);
  }
  return $total / $count;
}

print average(75, 95, 100) . PHP_EOL; // 90

function array_append(&$arr3, $x): void
{
  $values = func_get_args();
  array_shift($values);
  foreach ($values as $value) {
    $arr3[] = $value;
  }
}

$datum = array('apples', 'oranges');
$newArr = array_append($datum, 'grapes', 'pears');
print_r($newArr);