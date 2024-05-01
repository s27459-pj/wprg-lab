<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki</title>
</head>

<body>
    <?php
    function day_of_week($birthdate)
    {
        return date('l', strtotime($birthdate));
    }

    function get_age($birthdate)
    {
        $birth = strtotime($birthdate);
        $now = time();
        $age = date('Y', $now) - date('Y', $birth);
        if (date('md', $now) < date('md', $birth)) {
            $age--;
        }
        return $age;
    }

    function next_birthday($birthdate)
    {
        $today = date('Y-m-d');
        $next_birthday = date('Y') . '-' . date('m-d', strtotime($birthdate));
        if ($today > $next_birthday) {
            // Increment year if birthday has already passed
            $next_birthday = (date('Y') + 1) . '-' . date('m-d', strtotime($birthdate));
        }
        return $next_birthday;
    }

    function days_until_next_birthday($birthdate)
    {
        $next_birthday = next_birthday($birthdate);
        $today = date('Y-m-d');
        return (strtotime($next_birthday) - strtotime($today)) / (60 * 60 * 24);
    }

    if (isset($_GET['birthdate'])) {
        $birthdate = $_GET['birthdate'];
        $birth_date_weekday = day_of_week($birthdate);
        $age = get_age($birthdate);
        $days_until_birthday = days_until_next_birthday($birthdate);

        echo "<p>Urodziłeś/aś się w $birth_date_weekday</p>";
        echo "<p>Ukończyłeś/aś $age lat(a)</p>";
        echo "<p>Do Twoich kolejnych urodzin pozostało $days_until_birthday dni</p>";
    } else {
        echo "<p>Nie podano daty urodzenia.</p>";
    }
    ?>
</body>

</html>
