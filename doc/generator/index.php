<?php
//function xrange($start, $limit, $step = 1): Generator
//{
//  if ($start <= $limit) {
//    if ($step <= 0){
//      throw new LogicException('Step must be positive');
//    }
//
//    for ($i = $start; $i <= $limit; $i += $step) {
//      yield $i;
//    }
//  } else {
//    if ($step >= 0) {
//      throw new LogicException('Step must be negative.');
//    }
//    for ($i = $start; $i >= $limit; $i += $step) {
//      yield $i;
//    }
//  }
//}
//
///*
// * Note that both range() and xrange() result in the same
// * output below.
// */
//echo 'Single digit odd numbers from range():  ';
//foreach (range(1, 9, 2) as $number) {
//  echo "$number "; // 1 3 5 7 9
//}
//echo "\n";
//
//echo 'Single digit odd numbers from xrange(): ';
//foreach (xrange(1, 9, 2) as $number) {
//  echo "$number "; // 1 3 5 7 9
//}
//echo "\n";
//
//echo 'Single digit odd numbers from xrange(): ';
//foreach (xrange(9, 1, -2) as $number) {
//  echo "$number "; //  9 7 5 3 1
//}
//echo "\n";
///**
// * @param $file
// * @return Generator
// */
//function getLines($file): Generator
//{
//  $f = fopen($file, 'r');
//  try {
//    while($line = fgets($f)) {
//      yield $line;
//    }
//  } finally {
//    fclose($f);
//  }
//}
//
//foreach (getLines("file.txt") as $n => $line) {
//  if ($n > 5) break;
//  echo $line;
//}

//$start_time = microtime(true);
//$arr = [];
//$result = '';
//
//for ($count=1000000;$count--;) {
//  $arr[] = $count/2;
//}
//
//foreach ($arr as $val) {
//  $val+= 145.56;
//  $result .=$val;
//}
//
//$end_time = microtime(true);
//
//
//print "time: " . bcsub($end_time, $start_time, 4) . PHP_EOL;
//print "memory (byte): " . memory_get_peak_usage(true) . PHP_EOL;

//$start_time = microtime(true);
//$result = '';
//function it(): Generator
//{
//  for ($count = 1000000; $count--;) {
//    yield $count / 2;
//  }
//}

//foreach (it() as $val) {
//  $val += 145.56;
//  $result .= $val;
//}
//
//$end_time = microtime(true);
//echo "time: ", bcsub($end_time, $start_time, 4), "\n";
//echo "memory (byte): ", memory_get_peak_usage(true), "\n";
//

//function gen_one_to_three() {
//  for ($i = 1; $i <= 3; $i++) {
//    yield $i;
//  }
//}
//
//foreach (gen_one_to_three() as $value)
//  print $value . PHP_EOL;


/*
 * The input is semicolon separated fields, with the first
 * field being an ID to use as a key.
 */
//
//$input = <<<'EOF'
//1;PHP;Likes dollar signs
//2;Python;Likes whitespace
//3;Ruby;Likes blocks
//EOF;
//
//function input_parser($input): Generator
//{
//  foreach (explode("\n", $input) as $line) {
//    $fields = explode(';', $line);
//    $id = array_shift($fields);
//    yield $id => $fields;
//  }
//}
//
//foreach (input_parser($input) as $id => $fields) {
//  print "$id:" . PHP_EOL;
//  print "   {$fields[0]}" . PHP_EOL;
//  print "   {$fields[1]}" . PHP_EOL;
//}

//function inner() {
//  yield 1; // key 0
//  yield 2; // key 1
//  yield 3; // key 2
//}
//function gen() {
//  yield 0; // key 0
//  yield from inner(); // keys 0-2
//  yield 4; // key 1
//}
//// pass false as second parameter to get an array [0, 1, 2, 3, 4]
//print_r(iterator_to_array(gen()));

# Example #6 Basic use of yield from
//function count_to_ten(): Generator
//{
//  yield 1;
//  yield 2;
//  yield from [3, 4];
//  yield from new ArrayIterator([5, 6]);
//  yield from seven_eight();
//  yield 9;
//  yield 10;
//}
//
//function seven_eight(): Generator
//{
//  yield 7;
//  yield from eight();
//}
//
//function eight(): Generator
//{
//  yield 8;
//}

//foreach (count_to_ten() as $num)
//  print "$num "; // The above example will output: 1 2 3 4 5 6 7 8 9 10

# Example #7 yield from and return values
//function count_to_ten(): Generator
//{
//  yield 1;
//  yield 2;
//  yield from [3, 4];
//  yield from new ArrayIterator([5, 6]);
//  yield from seven_eight();
//  return yield from nine_ten();
//}
//
//function seven_eight(): Generator
//{
//  yield 7;
//  yield from eight();
//}
//
//function eight(): Generator
//{
//  yield 8;
//}
//
//function nine_ten(): int|Generator
//{
//  yield 9;
//  return 10;
//}
//
//$gen = count_to_ten();
//
//foreach ($gen as $num) {
//  echo "$num ";
//}
//
//echo $gen->getReturn(); // 1 2 3 4 5 6 7 8 9 10

# For example yield keyword with Fibonacci:
function getFibonacci(): Generator
{
  $i = 0;
  $k = 1; // first fibonacci value
  yield $k;
  while (true) {
    $k = $i + $k;
    $i = $k - $i;
    yield $k;
  }
}

$y = 0;

foreach (getFibonacci() as $fibonacci) {
  print $fibonacci . PHP_EOL;
  $y++;
  if ($y > 8) {
    break; // infinite loop prevent
  }
}
