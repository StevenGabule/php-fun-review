<?php
/***
 * Functions for inspecting an object
 * class_exists($class)
 * get_class($object)
 * is_a($object, $class)
 * property_exists($object, $property)
 * method_exists($object, $method)
 ***/


// INHERITANCE
class Person {
  private $firstName, $lastName, $phone, $email;

  public function __construct($first, $last)
  {
    $this->firstName = $first;
    $this->lastName = $last;
  }

  public function getFirstName() {return $this->firstName;}
  public function setFirstName($v): void {$this->firstName=$v;}
  public function getLastName($v) {return $this->lastName;}
  public function setLastName($v): void {$this->lastName=$v;}
  public function getPhone($v) {return $this->phone;}
  public function setPhone($v): void {$this->phone=$v;}
  public function getEmail() {return $this->email;}
  public function setEmail($v): void {$this->email=$v;}
}

class Employee extends Person {
  private $ssn, $hireDate;
  public function __construct($first, $last, $ssn, $hireDate)
  {
    $this->ssn = $ssn;
    $this->hireDate = $hireDate;

    // call Person constructor to finish initialization
    parent::__construct($first, $last);
  }

  public function getSSN($v) {return $this->ssn;}
  public function setSSN($v): void {$this->ssn=$v;}
  public function getHireDate($v) {return $this->hireDate;}
  public function setHireDate($v): void {$this->hireDate=$v;}
}

$emp = new Employee('John', 'Doe', '9938388-21321', '0923838');
$emp->setPhone('12321312214');
$emp->setEmail('emailone@gmail.com');
print $emp->getEmail();

abstract class APerson {
  private $fn, $ln, $phone, $email;
  public function __construct($first, $last)
  {
    $this->fn = $first;
    $this->ln = $last;
  }

  public function getFirstName() {return $this->fn;}
  public function setFirstName($v): void {$this->fn=$v;}
  public function getLastName($v) {return $this->ln;}
  public function setLastName($v): void {$this->ln=$v;}
  public function getPhone($v) {return $this->phone;}
  public function setPhone($v): void {$this->phone=$v;}
  public function getEmail() {return $this->email;}
  public function setEmail($v): void {$this->email=$v;}
  abstract public function getFullName();
}

class ACustomer extends APerson {

  public function getFullName()
  {
    // TODO: Implement getFullName() method.
  }
}
