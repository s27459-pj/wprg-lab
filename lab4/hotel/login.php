<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo "<p>Strona dostępna tylko po wysłaniu formularza logowania</p>";
  echo "<p><a href='login.html'>Wróć do formularza logowania</a></p>";
  exit;
}

if (isset($_COOKIE["session"])) {
  echo "<p>Jesteś już zalogowany</p>";
  echo "<p><a href='index.php'>Wróć do formularza rezerwacji</a></p>";
  exit;
}

$users = [
  'admin' => 'admin1234',
];

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($users[$username]) || $users[$username] !== $password) {
  echo "<p>Niepoprawne dane logowania</p>";
  echo "<p><a href='login.html'>Wróć do formularza logowania</a></p>";
  exit;
}

$session_id = uniqid();
$session = [
  'username' => $username,
  'session_id' => $session_id,
];
$cookie_expire = time() + 60 * 60 * 24;
setcookie('session', json_encode($session), $cookie_expire);
header('Location: index.php');
