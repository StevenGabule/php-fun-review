<?php
//
//$string = 'name';
//print htmlspecialchars($string, false);
//
//class CPostsController {
//  /**
//   * @Route("/api/posts/{id}", methods={"GET"})
//   */
//  public function get($id){}
//}
class C8PostsController {
  #[Route("/api/posts/{id}", methods:["GET"])]
  public function get($id){}
}
//
//class Point {
//  public function __construct(
//    public float $x = 0.0,
//    public float $y = 0.0,
//    public float $z = 0.0
//  ) {}
//}
//
//class Number {
//  public int|float $num;
//  public function __construct(public int|float $number)
//  {
//    $this->num = $number;
//  }
//}
//
//echo match (8.0) {
//  '8.0' => 'Oh no!',
//  8.0 => 'This is what is expected.'
//};
//
//enum Cards: string
//{
//  case Heart = "Heart";
//  case Diamonds = "Diamonds";
//  case Clubs = "Clubs";
//  case Spaces = "Spaces";
//
//  public function setCards(): string
//  {
//    return match ($this) {
//      self::Heart => 'Heart',
//      self::Diamonds => 'Diamonds',
//      self::Clubs => 'Clubs',
//      self::Spaces => 'Spaces',
//    };
//  }
//}

//print Cards:: . PHP_EOL;
$arrA = ['a' => 'A'];
$arrB = ['b' => 'B'];
$arr = [...$arrA, ...$arrB];
print_r($arr);

//$numbers = [1, 2, 3, 4, 5, 6];
//$evens = array_filter(array: $numbers, callback: function($n) {
//  return $n % 2 === 0;
//});
//
//$squares = array_map(array: $numbers, callback: function ($n) {
//  return $n * $n;
//});
//
//$pos = strpos('Hello world', 'world');
//echo '<pre>';
//var_dump($pos, $evens, $squares);
//echo '</pre>';

class Person {
  public function __construct(public string $firstName, public string $lastName)
  {
  }

  public function getFirstname(): string
  {
    return $this->firstName;
  }
}

$person = new Person('John', 'Gabs');
print $person->getFirstname(). PHP_EOL;

# Null safe operator
$country = null;
$session = null;
if ($session !== null) {
  $user = $session->user;

  if ($user !== null) {
    $address = $user->getAddress();

    if($address !== null) {
      $country = $address->country;
    }
  }
}

// php8.*
$country = $session?->user?->getAddress()?->country;