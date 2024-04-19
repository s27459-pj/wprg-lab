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
    $number_of_guests = $_POST['number_of_guests'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $credit_card = $_POST['credit_card'];
    $email = $_POST['email'];
    $arrival_date = $_POST['arrival_date'];
    $arrival_time = $_POST['arrival_time'];
    $child_bed = isset($_POST['child_bed']) ? 'Tak' : 'Nie';
    $amenities = isset($_POST['amenities']) ? implode(', ', $_POST['amenities']) : 'Brak';

    echo "<p>Liczba osób: $number_of_guests</p>";
    echo "<p>Imię: $name</p>";
    echo "<p>Nazwisko: $surname</p>";
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
