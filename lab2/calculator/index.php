<?php
// Prosty kalkulator:
// 1. stwórz formularz z miejscem na wpisanie 2 liczb oraz wyborem działania
//    (dodawanie, odejmowanie, mnożenie, dzielenie)
// 2. stwórz skrypt PHP, który obsłuży dane z formularza
//    (na podstawie wybranego działania policzy i wyświetli wynik w przeglądarce)

function validate($num1, $num2, $operation)
{
    if ($num1 == '' || $num2 == '') {
        return "Podaj jakieś liczby";
    }
    if (filter_var($num1, FILTER_VALIDATE_FLOAT) === false || filter_var($num2, FILTER_VALIDATE_FLOAT) === false) {
        return "Wpisane wartości muszą być liczbami";
    }
    if ($operation == "/" && ($num1 == 0 || $num2 == 0)) {
        return "Nie można dzielić przez 0";
    }
    return null;
}

function calculate($num1, $num2, $operation)
{
    if ($operation == "add")
        return $num1 + $num2;
    if ($operation == "sub")
        return $num1 - $num2;
    if ($operation == "mul")
        return $num1 * $num2;
    if ($operation == "div")
        return $num1 / $num2;
}

function operationToString($operation)
{
    if ($operation == "add")
        return "+";
    if ($operation == "sub")
        return "-";
    if ($operation == "mul")
        return "*";
    if ($operation == "div")
        return "/";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kalkulator</title>
</head>

<body>
    <main>
        <form method="post" action="">
            <label for="num1">Liczba 1</label>
            <input type="number" name="num1" id="num1" />
            <label for="num2">Liczba 2</label>
            <input type="number" name="num2" id="num2" />

            <input type="radio" name="operation" value="add" id="add" />
            <label for="add">Dodawanie</label>
            <input type="radio" name="operation" value="sub" id="sub" />
            <label for="sub">Odejmowanie</label>
            <input type="radio" name="operation" value="mul" id="mul" />
            <label for="mul">Mnożenie</label>
            <input type="radio" name="operation" value="div" id="div" />
            <label for="div">Dzielenie</label>

            <button type="submit">Oblicz</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST['num1']) || !isset($_POST['num2']) || !isset($_POST['operation'])) {
                echo "<p>Wypełnij wszystkie pola</p>";
                return;
            }
            $num1 = floatval($_POST['num1']);
            $num2 = floatval($_POST['num2']);
            $operation = $_POST['operation'];

            if ($error = validate($num1, $num2, $operation)) {
                echo "<p>Błąd: $error</p>";
                return;
            }

            $result = calculate($num1, $num2, $operation);
            echo "<p>Wynik: $num1 " . operationToString($operation) . " $num2 = $result</p>";
        }
        ?>
    </main>
</body>

</html>
