<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik</title>
</head>

<body>
    <h1>Wynik</h1>
    <?php
    function isPrime($number, &$iterations)
    {
        if ($number <= 1)
            return false;

        for ($i = 2; $i <= sqrt($number); $i++) {
            $iterations++;
            if ($number % $i === 0)
                return false;
        }

        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST['number'];

        if (!is_numeric($number) || $number <= 0 || intval($number) != $number) {
            echo "<p>Podaj liczbę całkowitą dodatnią.</p>";
        } else {
            $iterations = 0;
            $isPrime = isPrime($number, $iterations);
            echo "<p>Liczba $number " . ($isPrime ? "jest" : "nie jest") . " liczbą pierwszą.</p>";
            echo "<p>Liczba iteracji pętli potrzebnych do sprawdzenia: $iterations</p>";
        }
    }
    ?>
</body>

</html>
