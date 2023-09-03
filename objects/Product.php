<?php

class Product
{
  const MALE = 'M';
  const FEMALE = 'F';
  private static $objectCount = 0; // declare a static property
  private $category, $id, $code, $name, $price;

  public function __construct($category, $code, $name, $price)
  {
    $this->category = $category;
    $this->code = $code;
    $this->name = $name;
    $this->price = $price;
  }

  // a public method that gets the static property
  public static function getObjectCount(): int
  {
    return self::$objectCount;
  }

  public function getCategory()
  {
    return $this->category;
  }

  public function setCategory($value): void
  {
    $this->category = $value;
  }

  public function getID()
  {
    return $this->id;
  }

  public function setID($id): void
  {
    $this->id = $id;
  }
  public function getCode()
  {
    return $this->code;
  }

  public function setCode($value): void
  {
    $this->code = $value;
  }
  public function getName()
  {
    return $this->name;
  }

  public function setName($value): void
  {
    $this->name = $value;
  }
  public function getPrice()
  {
    return $this->price;
  }

  public function setPrice($price): void
  {
    $this->price = $price;
  }

  public function getPriceFormatted(): string
  {
    return number_format($this->price, 2);
  }

  public function getDistancePercent(): int
  {
    return 30;
  }

  public function getDistanceAmount(): string
  {
    return number_format(round(($this->price * ($this->getDistancePercent() / 100)), 2), 2);
  }

  public function getDistancePrice(): string
  {
    return number_format($this->price - $this->getDistanceAmount(),2);
  }

  public function getImageFileName(): string
  {
    return $this->code . '.png';
  }

  public function getImagePath(): string
  {
    return "../images/{$this->getImageFileName()}";
  }

  public function getImageAltText(): string
  {
    return "Image {$this->getImageFileName()}";
  }
}

print Product::MALE;