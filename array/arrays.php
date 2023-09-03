<?php
$arr = [1, 2, 3, 4, 5, null, ''];
echo count($arr);
echo PHP_EOL;

$arr1 = array('1', '2', '3', null, '6');
$arr1 = array_values($arr1);
echo implode('|', $arr1);
echo PHP_EOL;

print end($arr1);
echo PHP_EOL;

print key($arr1);
echo PHP_EOL;
$ranges = range(10, 100, 10);
echo implode('|', $ranges) . PHP_EOL; // 10|20|30|40|50|60|70|80|90|100
echo "Total Sum: " . array_sum($ranges) . PHP_EOL; // TOTAL SUM: 550

$numbers = array_fill(0, 5, 1);
print implode(',', $numbers) . PHP_EOL; // 1,1,1,1,1

$numbers = array_pad($numbers, 10, 2); // 1,1,1,1,1,2,2,2,2,2
print implode(',', $numbers) . PHP_EOL;

$employees = array('Mike', 'Anne');
$new_hires = array('Ray', 'Pren');
$return_hires = array('John');
$employees = array_merge($employees, $new_hires, $return_hires);
print implode(', ', $employees) . PHP_EOL; // Mike, Anne, Ray, Pren, John

// slice
$employees = array_slice($employees, 1);
$employees_cut = array_slice($employees, 1, 2);
print implode(', ', $employees) . PHP_EOL; // Anne, Ray, Pren, John
print implode(', ', $employees_cut) . PHP_EOL; // Ray, Pren

// array functions
// - array_push
// - array_pop
// - array_unshift
// - array_shift
// - array_sum
// - in_array
// - array_key_exists
// - array_search
// - array_count_values
// - array_unique
// array_reverse
// shuffle
// array_rand
// ** How to shuffle and deal a deck of cards
$faces = array('2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A');
$suits = array('h', 'd', 'c', 's');
$cards = array();

foreach ($faces as $face) {
  foreach ($suits as $suit) {
    $cards[] = $face . $suit;
  }
}

// shuffle the deck and deal the cards
shuffle($cards);
//print_r($cards) . PHP_EOL;
$hand = array();
for ($i = 0; $i < 5; $i++) {
  $hand[] = array_pop($cards);
}
print implode(', ', $hand) . PHP_EOL; // 2h, 4c, 6c, 4s, 4h


// MORE ARRAY EXAMPLES
$times_table = array();
for ($j = 0; $j <= 10; $j++) {
  $times_table[$j] = array();
}

for ($k = 1; $k <= 10; $k++) {
  for ($l = 1; $l <= 10; $l++) {
    $times_table[$k][$l] = $k * $l;
  }
}

foreach ($times_table as $tt) {
  print implode("\t", $tt) . PHP_EOL;
}







