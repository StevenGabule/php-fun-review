<?php

interface IShowable {
  public function show();
}

interface ITestable {
  public function test1($v1);
  public function test2($v2);
}

interface IGender {
  const MALE = 'm';
  const FEMALE = 'f';
}

// A class that inherits a class and implements an interface
class Employee extends Person implements IShowable, IGender, ITestable {

  public function show(): void
  {
    print self::MALE;
    print self::FEMALE;
  }

  public function test1($v1)
  {
    // TODO: Implement test1() method.
  }

  public function test2($v2)
  {
    // TODO: Implement test2() method.
  }
}



















