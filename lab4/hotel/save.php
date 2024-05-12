<?php

if (!isset($_COOKIE["session"])) {
    echo "<p>Nie jesteś zalogowany</p>";
    echo "<p><a href='login.html'>Zaloguj się</a></p>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<p>Strona dostępna tylko po wysłaniu formularza rezerwacji</p>";
    echo "<p><a href='index.php'>Wróć do formularza rezerwacji</a></p>";
    exit;
}

function setFormFieldCookie($name, $value)
{
    $cookie_name = "form__$name";
    $cookie_expire = time() + 60 * 60 * 24;
    setcookie($cookie_name, $value, $cookie_expire);
}

$number_of_guests = $_POST['number_of_guests'];
$address = $_POST['address'];
$credit_card = $_POST['credit_card'];
$email = $_POST['email'];
$arrival_date = $_POST['arrival_date'];
$arrival_time = $_POST['arrival_time'];
$child_bed = isset($_POST['child_bed']) ? 'Tak' : 'Nie';
$amenities = isset($_POST['amenities']) ? implode(', ', $_POST['amenities']) : 'Brak';

$cookie_expire = time() + 60 * 60 * 24;
setFormFieldCookie('number_of_guests', $number_of_guests);
setFormFieldCookie('address', $address);
setFormFieldCookie('credit_card', $credit_card);
setFormFieldCookie('email', $email);
setFormFieldCookie('arrival_date', $arrival_date);
setFormFieldCookie('arrival_time', $arrival_time);
setFormFieldCookie('child_bed', $child_bed);
setFormFieldCookie('amenities', $amenities);
for ($i = 1; $i <= $number_of_guests; $i++) {
    $guest_name = $_POST["name$i"];
    $guest_surname = $_POST["surname$i"];
    setFormFieldCookie("name$i", $guest_name);
    setFormFieldCookie("surname$i", $guest_surname);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie rezerwacji</title>
</head>

<body>
    <h1>Podsumowanie rezerwacji</h1>
    <?php
    echo "<p>Liczba osób: $number_of_guests</p>";

    for ($i = 1; $i <= $number_of_guests; $i++) {
        $guest_name = $_POST["name$i"];
        $guest_surname = $_POST["surname$i"];

        echo "<p>Osoba $i: $guest_name $guest_surname</p>";
    }

    echo "<p>Adres: $address</p>";
    echo "<p>Dane karty kredytowej: $credit_card</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Data przyjazdu: $arrival_date</p>";
    echo "<p>Godzina przyjazdu: $arrival_time</p>";
    echo "<p>Dostawka dla dziecka: $child_bed</p>";
    echo "<p>Udogodnienia: $amenities</p>";
    ?>
</body>

</html>
