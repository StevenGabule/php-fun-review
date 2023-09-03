<?php

namespace bar;

trait THelper
{
  public function sayHello(): void
  {
    print 'Hello' . PHP_EOL;
  }
}
trait TWorld
{
  public function sayWorld(): void
  {
    print 'World' . PHP_EOL;
  }
}
class MyHelloWorld
{
  use THelper, TWorld;
  public function sayExplamationMark(): void
  {
    print '!' . PHP_EOL;
  }
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExplamationMark();