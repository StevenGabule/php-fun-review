<?php
// set a cookie
$name = 'userid';
$value = 'rharris';
$expire = strtotime('+1 year');
$path = '/';
setcookie($name, $value, $expire, $path);

// get the value of a cookie from the browser
$userid = $_COOKIE['userid'];

// delete a cookie from the browser
$expire = strtotime('-1 year');
setcookie('userid', '', $expire, $path);

// start a session with custom cookie parameters
$lifetime = 60 * 60 * 24 * 365; // 1 year in seconds
session_set_cookie_params($lifetime, $path);
session_start();

/**
 * How to set and get scalar variables
 **/
# Set a variable in a session
$_SESSION['product_code'] = 'MBT-1753';

# Get a variable in a session
$product_code = $_SESSION['product_code'];

/**
 * How to set and get arrays
 **/
# Set an array in a section
if(!isset($_SESSION['Cart'])) {
  $_SESSION['cart'] = [];
}

# Add an element to an array that's stored in a session
$_SESSION['cart']['key1'] = 'value1';
$_SESSION['cart']['key2'] = 'value2';

# Get and use an array that's stored in a section
$cart = $_SESSION['cart'];
foreach ($cart as $item) {
  print $item . PHP_EOL;
}

# How to remove variables from a session
unset($_SESSION['cart']);

# Remove all session variables
$_SESSION = array();

# End a session
$_SESSION = [];
session_destroy();

# Delete the session cookie from the browser
$name = session_name(); // get name of session cookie
$expire = strtotime('-1 year'); // create exp date in the past
$params = session_get_cookie_params(); // get session params
$path = $params['path'];
$domain = $params['domain'];
$secure = $params['secure'];
$httponly = $params['httponly'];
setcookie($name, '', $expire, $path, $domain,$secure, $httponly);














