<?php
require_once 'model/fields.php';
require_once 'model/validate.php';

// add fields with optional initial message
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('phone', 'Use 888-555-1234 format.');
$fields->addField('email', 'Must be a valid email address.');

$action = 'reset';
if (isset($_POST['action'])) $action = $_POST['action'];

$action = strtolower($action);
switch ($action) {
  case 'reset':
    include 'view/register.php';
    break;
  case 'register':
    // copy form values to local variables
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    // validate form data
    $validate->text('first_name', $first_name);
    $validate->text('last_name', $last_name);
    $validate->text('phone', $phone);
    $validate->text('email', $email);

    // load appropriate view based on hasErrors
    if ($fields->hasErrors()) {
      include 'view/register.php';
    } else {
      include 'view/success.php';
    }
    break;
  default:
    break;
}

