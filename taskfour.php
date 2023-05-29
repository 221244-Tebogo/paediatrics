<?php

// 1. Nested for loop to create the pattern
// Constructing the pattern
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}
for ($i = 4; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
     echo "<br>";
}

echo "\n--------------------------------------\n";

// 2. FizzBuzz program
echo "FizzBuzz:\n";
for ($i = 1; $i <= 50; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz\n";
    } elseif ($i % 3 == 0) {
        echo "Fizz\n";
    } elseif ($i % 5 == 0) {
        echo "Buzz\n";
    } else {
        echo $i . "\n";
    }
}

echo "\n--------------------------------------\n";

// 3. Current date formats
echo "Current Date:\n";
$today = date("Y/m/d");
echo $today . "\n";
$today = date("y.m.d");
echo $today . "\n";
$today = date("d-m-y");
echo $today . "\n";

 echo "<br>";

// 4. Date difference calculation
$date1 = new DateTime('1981-11-04');
$date2 = new DateTime('2013-09-04');
$interval = $date1->diff($date2);

$years = $interval->y;
$months = $interval->m;
$days = $interval->d;

echo "Date Difference:\n";
echo $years . " years, " . $months . " months, " . $days . " days\n";

 echo "<br>";

// 5. Removing last word from a string
echo "String without last word:\n";
$string = "The quick brown fox";
$words = explode(" ", $string);
array_pop($words);
$newString = implode(" ", $words);
echo $newString . "\n";

  echo "<br>";

// 6. Removing nonnumeric characters except comma and dot
echo "String with nonnumeric characters removed:\n";
$string = "$123,34.00A";
$cleanString = preg_replace("/[^0-9,.]/", "", $string);
echo $cleanString . "\n";

?>
