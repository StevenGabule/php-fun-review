<?php
// start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 12; // 2 weeks in seconds
session_set_cookie_params($lifetime);
session_start();

// create a cart array if needed
if (empty($_SESSION['cart12'])) $_SESSION['cart12'] = [];

// create a table of products
$products = [];
$products['MMS-1754'] = ['name' => 'Flute', 'cost' => 149.50];
$products['MMS-6289'] = ['name' => 'Trumpet', 'cost' => 199.99];
$products['MMS-3408'] = ['name' => 'Clarinet', 'cost' => 299.99];

// include cart functions
require_once('cart.php');

// get the sort key
$sort_key = 'name';
if(isset($_POST['sortKey'])) $sort_key = $_POST['sortKey'];

$action = 'show_add_item';

// get the action to perform
if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

if(isset($_GET['action'])) {
  $action = $_GET['action'];
}

// Add or update cart as needed
switch ($action) {
  case 'add':
    cart\add_item($_POST['productKey'], $_POST['qty']);
    include('cart_view.php');
    break;
  case 'update':
    $new_qty_list = $_POST['newQty'];
    foreach ($new_qty_list as $key => $qty) {
      if ($_SESSION['cart12'][$key]['qty'] != $qty) {
        cart\update_item($key, $qty);
      }
    }
    cart\sort($sort_key);
    include 'cart_view.php';
    break;
  case 'show_cart':
    cart\sort($sort_key);
    include 'cart_view.php';
    break;
  case 'show_add_item':
    include 'add_item_view.php';
    break;
  case 'empty_cart':
    unset($_SESSION['cart12']);
    include 'cart_view.php';
    break;
  default:
    break;
}