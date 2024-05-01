<!DOCTYPE html>
<html>

<head>
    <title>Formularz zarządzania katalogami</title>
</head>

<body>
    <h2>Formularz zarządzania katalogami</h2>
    <form action="" method="post">
        Ścieżka: <input type="text" name="path" value="./php/images/network"><br><br>
        Nazwa katalogu: <input type="text" name="dirName" value="example"><br><br>
        Operacja:
        <select name="operation">
            <option value="read">Odczyt</option>
            <option value="delete">Usuwanie</option>
            <option value="create">Tworzenie</option>
        </select><br><br>
        <input type="submit" name="submit" value="Wykonaj">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $path = $_POST["path"];
        $dirName = $_POST["dirName"];
        $operation = $_POST["operation"];

        echo "<p>Wynik operacji: " . manageDirectory($path, $dirName, $operation) . "</p>";
    }
    ?>
</body>

</html>

<?php
function manageDirectory($path, $dirName, $operation = 'read')
{
    if (substr($path, -1) !== '/') {
        $path .= '/';
    }

    switch ($operation) {
        case 'read':
            return readDirectory($path . $dirName);
        case 'delete':
            return deleteDirectory($path . $dirName);
        case 'create':
            return createDirectory($path . $dirName);
        default:
            return "Nieprawidłowa operacja.";
    }
}

function readDirectory($dirPath)
{
    if (!is_dir($dirPath)) {
        return "Katalog nie istnieje.";
    }

    $files = scandir($dirPath);
    $files = array_diff($files, array('.', '..'));
    if (empty($files)) {
        return "Katalog jest pusty.";
    }

    return implode(", ", $files);
}

function deleteDirectory($dirPath)
{
    if (!is_dir($dirPath)) {
        return "Katalog nie istnieje.";
    }

    if (count(scandir($dirPath)) > 2) {
        return "Katalog nie jest pusty.";
    }

    if (rmdir($dirPath)) {
        return "Katalog został usunięty.";
    } else {
        return "Nie udało się usunąć katalogu.";
    }
}

function createDirectory($dirPath)
{
    if (is_dir($dirPath)) {
        return "Katalog już istnieje.";
    }

    if (mkdir($dirPath, 0777, true)) {
        return "Katalog został utworzony.";
    } else {
        return "Nie udało się utworzyć katalogu.";
    }
}
