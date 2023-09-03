<?php


function add_item($key, $quantity): void
{
  global $products;
  if ($quantity < 1) return;

  // if item already exists in the cart, update the quantity
  if (isset($_SESSION['cart12'][$key])) {
    $quantity += $_SESSION['cart12'][$key]['qty'];
    update_item($key, $quantity);
    return;
  }

  // add item
  $cost = $products[$key]['cost'];
  $total = $cost * $quantity;
  $item = array(
    'name' => $products[$key]['name'],
    'cost' => $cost,
    'qty' => $quantity,
    'total' => $total
  );
  $_SESSION['cart12'][$key] = $item;
}
function update_item($key, $quantity): void
{
  $quantity = (int) $quantity;
  if (isset($_SESSION['cart12'][$key])) {
    if ($quantity <= 0) {
      unset($_SESSION['cart12'][$key]);
    } else {
      $_SESSION['cart12'][$key]['qty'] = $quantity;
      $total = $_SESSION['cart12'][$key]['cost'] * $_SESSION['cart12'][$key]['qty'];
      $_SESSION['cart12'][$key]['total'] = $total;
    }
  }
}

// Get cart subtotal
function get_subtotal(): string
{
  $subtotal = 0;
  foreach ($_SESSION['cart12'] as $item) {
    $subtotal += $item['total'];
  }
  return number_format($subtotal, 2);
}