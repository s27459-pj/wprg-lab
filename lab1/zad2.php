<?php
// 2. Napisz program, który wypisze na ekranie wszystkie liczby pierwsze z zadanego zakresu.

function is_prime($number)
{
    if ($number <= 2)
        return true;
    for ($i = 2; $i < $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}

if ($argc != 3) {
    echo "Usage: php zad2.php <range start> <range end>\n";
    exit (1);
}

$start = $argv[1];
$end = $argv[2];

for ($i = $start; $i <= $end; $i++) {
    if (is_prime($i)) {
        echo $i . "\n";
    }
}
