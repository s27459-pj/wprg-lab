<?php
if (!isset($_COOKIE["session"])) {
  echo "<p>Nie jesteś zalogowany</p>";
  echo "<p><a href='index.php'>Wróć do formularza rezerwacji</a></p>";
  echo "<p><a href='login.html'>Zaloguj się</a></p>";
  exit;
}

setcookie('session', '', time() - 3600);
header('Location: index.php');
