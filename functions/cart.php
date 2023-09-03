<?php
function cart_add_item(&$cart, $name, $cost, $qty): void
{
  $total = $cost * $qty;
  $item = array(
    'name' => $name,
    'cost' => $cost,
    'qty' => $qty,
    'total' => $total,
  );
  $cart[] = $item;
}

function cart_update_item(&$cart, $key, $qty): void
{
  if (isset($cart[$key])) {
    if ($qty <= 0) {
      unset($cart[$key]);
    } else {
      $cart[$key]['qty'] = $qty;
      $total = $cart[$key]['cost'] * $cart[$key]['qty'];
      $cart[$key]['total'] = $total;
    }
  }
}

function cart_get_subtotal($cart): string
{
  $subtotal = 0;
  foreach ($cart as $item) {
    $subtotal += $item['total'];
  }
  return number_format(round($subtotal, 2), 2);
}

$cart = array();
cart_add_item($cart, 'Flute', 149.11, 2);
cart_update_item($cart, 0, 2);
$subtotal = cart_get_subtotal($cart);
print "This is the subtotal of purchase: {$subtotal}" . PHP_EOL;

# How to pass one function to another
// A variable function
$fun = (mt_rand(0, 1) == 1) ? 'array_sum' : 'array_product';
$val = array(4, 9, 16);
$result = $fun($val);

// A function that uses a callback
function validate($data, $functions): bool
{
  $valid =  true;
  foreach ($functions as $function) {
    $valid = $valid && $function($data);
  }
  return $valid;
}

function is_at_least_18($number): bool
{
  return $number >= 18;
}

function is_less_than_62($number): bool
{
  return $number < 62;
}

$age = 25;
$functions = array('is_numeric', 'is_at_least_18', 'is_less_than_62');
$is_valid_age = validate($age, $functions);
print $is_valid_age . PHP_EOL; // 1 OR TRUE


$compare_function = function($left, $right) {
  $l = (float)$left;
  $r = (float)$right;
  if($l < $r) return -1;
  if($l > $r) return 1;
  return 0;
};

$new_result = $compare_function(3,5);
print $new_result . PHP_EOL;

$n_v = array(5,2,4,1,3);
print usort($n_v, $compare_function) . PHP_EOL;

// how to create a closure
$employees = [
  ['name' => 'Ray', 'id'=> 213],
  ['name' => 'Mike', 'id'=> 345],
  ['name' => 'Annae', 'id'=> 612],
  ['name' => 'Pren', 'id'=> 124],
  ['name' => 'Joel', 'id'=> 221],
];

// a function to sort the array by any column
function array_compare_factory($sort_key): Closure
{
  return function($left, $right) use ($sort_key) {
    if ($left[$sort_key] < $right[$sort_key]) return -1;
    else if($left[$sort_key] > $right[$sort_key]) return 1;
    else return 0;
  };
}

$sort_by = array_compare_factory('id');
usort($employees, $sort_by);
print_r($employees);