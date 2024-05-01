<?php
function factorial_recursive($n)
{
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial_recursive($n - 1);
    }
}

function factorial_iterative($n)
{
    $factorial = 1;
    for ($i = 2; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

function measure_time($function, $n)
{
    $runs = 10_000;
    $total_time = 0;
    for ($i = 0; $i < $runs; $i++) {
        $start = microtime(true);
        $result = $function($n);
        $end = microtime(true);
        $total_time += $end - $start;
    }
    return [$result, $total_time / $runs];
}

function main()
{
    $n = 10000;
    list($result_recursive, $time_recursive) = measure_time('factorial_recursive', $n);
    list($result_iterative, $time_iterative) = measure_time('factorial_iterative', $n);

    if ($time_recursive < $time_iterative) {
        $faster_function = "rekurencyjna";
        $time_difference = $time_iterative - $time_recursive;
    } else {
        $faster_function = "iteracyjna";
        $time_difference = $time_recursive - $time_iterative;
    }

    echo "Silnia (Rekurencyjna): $result_recursive\n";
    echo "Czas wykonania rekurencyjnej funkcji: $time_recursive sekund\n\n";

    echo "Silnia (Iteracyjna): $result_iterative\n";
    echo "Czas wykonania iteracyjnej funkcji: $time_iterative sekund\n\n";

    echo "Funkcja $faster_function jest szybsza z różnicą czasu $time_difference sekund.\n";
}
main();
