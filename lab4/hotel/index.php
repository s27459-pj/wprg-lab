<?php
if (!isset($_COOKIE["session"])) {
  echo "<p>Nie jesteś zalogowany</p>";
  echo "<p><a href='login.html'>Zaloguj się</a></p>";
  exit;
}

$session = json_decode($_COOKIE["session"], true);
$username = $session['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rezerwacja hotelowa</title>
</head>

<body>
  <h1>Formularz rezerwacji hotelowej</h1>
  <p>Zalogowano jako: <?php echo $username; ?></p>
  <p><a href="logout.php">Wyloguj się</a></p>

  <form method="post" action="save.php" id="reservation">
    <label for="number_of_guests">Liczba osób:</label>
    <select name="number_of_guests" id="number_of_guests">
      <option value="1" default>1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select><br />

    <div id="guests-form-container"></div>

    <label for="address">Adres:</label>
    <input type="text" name="address" id="address" required /><br />

    <label for="credit_card">Dane karty kredytowej:</label>
    <input type="text" name="credit_card" id="credit_card" required /><br />

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required /><br />

    <label for="arrival_date">Data przyjazdu:</label>
    <input type="date" name="arrival_date" id="arrival_date" required /><br />

    <label for="arrival_time">Godzina przyjazdu:</label>
    <input type="time" name="arrival_time" id="arrival_time" required /><br />

    <label for="child_bed">Dostawka dla dziecka:</label>
    <input type="checkbox" name="child_bed" id="child_bed" /><br />

    <label for="amenities">Udogodnienia:</label><br />
    <input type="checkbox" name="amenities[]" value="klimatyzacja" id="amenities__klimatyzacja" />
    Klimatyzacja<br />
    <input type="checkbox" name="amenities[]" value="popielniczka" id="amenities__popielniczka" />
    Popielniczka dla palacza<br />

    <button type="submit">Zarezerwuj</button>
    <button type="reset">Wyczyść</button>
  </form>
</body>

<script>
  const cookies = new Map(
    document.cookie.split("; ").map((cookie) => cookie.split("="))
  );
  const guestFormValues = {};

  function loadInitialValues() {
    const numberOfGuests = cookies.get("form__number_of_guests");
    if (numberOfGuests) populateGuestForms(numberOfGuests);

    for (const [name, rawValue] of cookies.entries()) {
      if (!name.startsWith("form__")) continue;
      const fieldID = name.replace("form__", "");
      const field = document.getElementById(fieldID);
      const value = decodeURIComponent(rawValue);

      if (fieldID === "amenities") {
        const values = value.split(", ");
        for (const amenity of values) {
          const checkbox = document.getElementById(`amenities__${amenity}`);
          if (checkbox) checkbox.checked = true;
        }
        continue;
      }

      if (fieldID === "child_bed") {
        field.checked = value === "Tak";
        continue;
      }

      if (field) field.value = value;

      if (/^name\d+$/.test(fieldID)) {
        const guestNumber = fieldID.replace("name", "");
        guestFormValues[guestNumber] = {
          name: value,
          ...guestFormValues[guestNumber],
        };
        continue;
      }
      if (/^surname\d+$/.test(fieldID)) {
        const guestNumber = fieldID.replace("surname", "");
        guestFormValues[guestNumber] = {
          surname: value,
          ...guestFormValues[guestNumber],
        };
        continue;
      }
    }
  }

  function getGuestForm(i, name, surname) {
    return `
        <fieldset>
          <legend>Dane osoby ${i}</legend>

          <label for="name${i}">Imię:</label>
          <input type="text" name="name${i}" id="name${i}" value="${name}" required>

          <label for="surname${i}">Nazwisko:</label>
          <input type="text" name="surname${i}" id="surname${i}" value="${surname}" required>
        </fieldset>
        `;
  }

  function populateGuestForms(numberOfGuests) {
    const formContainer = document.getElementById("guests-form-container");
    formContainer.innerHTML = "";
    for (var i = 1; i <= numberOfGuests; i++) {
      const name = guestFormValues[i] ? guestFormValues[i].name : "";
      const surname = guestFormValues[i] ? guestFormValues[i].surname : "";
      formContainer.innerHTML += getGuestForm(i, name, surname);
    }
  }
  document.addEventListener("DOMContentLoaded", () => {
    loadInitialValues();
  });

  function updateGuestForms() {
    const numberOfGuests = document.getElementById("number_of_guests").value;
    populateGuestForms(numberOfGuests);
  }
  document
    .getElementById("number_of_guests")
    .addEventListener("change", updateGuestForms);

  document
    .querySelector("#reservation>button[type=reset]")
    .addEventListener("click", () => {
      for (const [name, value] of cookies.entries()) {
        if (name.startsWith("form__")) {
          document.cookie = `${name}=; Max-Age=0; path=/;`;
        }
      }
    });
</script>

</html>
