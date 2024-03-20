<?php
// 3. Dla zadanego N napisz program wyliczający N-tą liczbę Fibonacciego.
// Ciąg powinien zostać zapisany w tablicy, a następnie program wypisze nieparzyste elementy tablicy.
// Każdy element powinien być w nowej linii, a linie powinny być ponumerowane.

function fibonacci($n)
{
    $fibonacci_seq = [0, 1];
    for ($i = 2; $i < $n; $i++) {
        $fibonacci_seq[$i] = $fibonacci_seq[$i - 1] + $fibonacci_seq[$i - 2];
    }
    return $fibonacci_seq;
}

if ($argc != 2) {
    echo "Usage: php zad3.php <N>\n";
    exit (1);
}

$fibonacci_seq = fibonacci($argv[1]);
foreach ($fibonacci_seq as $i => $value) {
    if ($value % 2 != 0) {
        echo $i . ": " . $value . "\n";
    }
}
