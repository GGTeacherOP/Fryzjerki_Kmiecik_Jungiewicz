<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Fryzjerski SigmaHair</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="icon"  href="zdjecia/favicon.png">
</head>
<body>
    <header>
        <div class="header1">
            <h1 class="nazwa_salonu">Salon Fryzjerski SigmaHair</h1>
        </div>
        <div class="header2">
          <button class="menu">☰ Menu</button>
          <nav class="linki">
              <ul>
              <li><a href="index.php">Strona główna</a></li>
              <li><a href="cennik.php">Cennik</a></li>

              <?php
  if (isset($_SESSION['id'])) {
    if ($_SESSION['rola'] == "klient") {
      ?>
      <li><a href="umow.php">Umów swoją wizytę</a></li>
      <li><a href="moje_wizyty.php">Moje wizyty</a></li>
      <li><a href="dodaj_opinie.php">Dodaj opinie</a></li>
      <li><a href="punkty.php">Moje punkty lojalnościowe</a></li>
      <li><a href="logout.php">Wyloguj się</a></li>
      <?php
    } elseif ($_SESSION['rola'] == "szef") {
      ?>
      <li><a href="grafik-admin.php">Sprawdź grafik salonu</a></li>
      <li><a href="dni_wolne.php">Dodaj dzien wolny</a></li>
      <li><a href="opinie-admin.php">Sprawdź opinie salonu</a></li>
      <li><a href="pracownicy-admin.php">Pracownicy</a></li>
      <li><a href="uslugi-admin.php">Usługi</a></li>
      <li><a href="logout.php">Wyloguj się</a></li>
      <?php
    }elseif ($_SESSION['rola'] == "fryzjer") {
      ?>
      <li><a href="grafik-pracownik.php">Sprawdź grafik</a></li>
      <li><a href="dni_wolne.php">Dodaj dzien wolny</a></li>
      <li><a href="logout.php">Wyloguj się</a></li>
    
      <?php
    }elseif ($_SESSION['rola'] == "sprzataczka") {
      ?>
      <li><a href="sprzataczka.php">Sprawdź grafik</a></li>
      <li><a href="dni_wolne.php">Dodaj dzien wolny</a></li>
      <li><a href="logout.php">Wyloguj się</a></li>
    
      <?php
    }
   
  } else {
    ?>
    <li><a href="login.php">Logowanie</a></li>
    <li><a href="rejestrowanie.php">Rejestracja</a></li>
    <li><a href="login.php">Umów swoją wizytę</a></li>
   

    <?php
  }
  ?>
              </ul>
          </nav>
      </div>
        <div class="header3">
            <img src="favicon.ico" alt="Logo Salonu Fryzjerskiego SigmaHair">
        </div>
    </header>
    <main class="cennik">
        <?php
if (!isset($_SESSION['id'])) {
    echo "<p>Musisz być zalogowany, aby dodać dzień wolny.</p>";
    exit();
}
?>
<h2>Dodaj dzień wolny</h2><hr>
    <form action="" method="post">
        <label for="data">Data wolna:</label><br>
        <input type="date" id="data" name="data" required><br><br>

        <label for="powod">Powód:</label><br>
        <textarea id="powod" name="powod" rows="4" placeholder="Podaj powód..." required></textarea><br><br>

        <input type="submit" value="Dodaj dzień wolny">
    </form>
<?php
 if (isset($_SESSION['komunikat'])) {
  echo '<h2>' . $_SESSION['komunikat'] . '</h2><hr>';
  unset($_SESSION['komunikat']);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serwer = "localhost";
    $user = "root";
    $haslo = "";
    $baza = "salon";

    $conn = mysqli_connect($serwer, $user, $haslo, $baza);
    if (!$conn) {
        die("Błąd połączenia: " . mysqli_connect_error());
    }
   

    $id_user = (int)$_SESSION['id'];

      $result = mysqli_query($conn, "SELECT id_pracownika FROM users WHERE id = $id_user LIMIT 1");
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<p>Nie znaleziono powiązanego pracownika dla tego użytkownika.</p>";
        exit();
    }
    $row = mysqli_fetch_assoc($result);
    $id_pracownika = (int)$row['id_pracownika'];

    $data_wolna = mysqli_real_escape_string($conn, $_POST['data']);
    $powod = mysqli_real_escape_string($conn, $_POST['powod']);

    // Sprawdza czy data nie jest pusta i ma poprawny format
    if ($data_wolna && $powod) {
        $sql = "INSERT INTO dni_wolne (id_pracownika, data_wolna, powod) 
                VALUES ('$id_pracownika', '$data_wolna', '$powod')";
 

 
 if (mysqli_query($conn, $sql)) {
  $_SESSION['komunikat'] = "Dzień wolny dodany!";
  mysqli_close($conn);
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}
    } else {
        echo "<p>Wszystkie pola są wymagane.</p>";
    }

   
}
?>
<h2>Twoje dni wolne</h2><hr>
<table >
  <tr class="tabelka_cennik">
    <th>Powód</th>
    <th>Data dnia wolnego</th>
  </tr>
<?php
 $serwer="localhost";
 $user="root";
 $haslo="";
 $baza="salon";
 $conn=mysqli_connect($serwer,$user,$haslo,$baza);
 
 if (isset($_SESSION['id'])) {
  $id_uzytkownika = (int)$_SESSION['id'];
  $zapytanie = "SELECT id_pracownika FROM users WHERE id = $id_uzytkownika";
  $wynik = mysqli_query($conn, $zapytanie);

  if ($wynik && mysqli_num_rows($wynik) > 0) {
      $wiersz = mysqli_fetch_assoc($wynik);
      $_SESSION['id_pracownika'] = $wiersz['id_pracownika'];
  } else {
      $_SESSION['id_pracownika'] = null;
  }
}
if (isset($_SESSION['id_pracownika'])) {
  $id_pracownika = (int)$_SESSION['id_pracownika'];
} else {
  echo "<p>Błąd: brak ID pracownika w sesji.</p>";
  exit; 
}
$kw1=("SELECT * from dni_wolne_pracownik where id_pracownika=$id_pracownika ");
$skrypt1=mysqli_query($conn,$kw1);
if (mysqli_num_rows($skrypt1) > 0) {
  while($row = mysqli_fetch_row($skrypt1)) {
      echo "<tr><td>".$row[1]."</td><td>"
          .$row[2] ."</td>
        </tr>";
  }
} else {
  echo "<tr><td colspan='5'>Brak wpisanego dnia wolnego dla tego pracownika.</td></tr>";
}
mysqli_close($conn);
?>

</table>
       </main>
    
    <footer>
        <div class="dane_kontaktowe">
          <h1>Kontakt</h1><br><hr>
          <ul class="kontakt">
            <li><h4>Aleksandra&nbspKmiecik</h4> <p>+48 999 888 777</p></li>
            <li><h4>Natalia&nbspJungiewicz</h4> <p>+48 666 555 444</p></li>
          </ul>
        </div>
        <div class="godziny_otwarcia">
          <h1>Godziny otwarcia</h1><br><hr>
          <h4>pon-pt: 10:00-20:00</h4>
          <h4>sob-nd: 12:00-20:00</h4>
        </div>
        <div class="miejsce">
          <h1>Miejsce salonu</h1><br><hr>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20393.138758562003!2d21.414070129394535!3d50.28927070553241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473d6b6c6d8b07ff%3A0x6bade516f8714a48!2zWmVzcMOzxYIgU3prw7PFgiBUZWNobmljem55Y2g!5e0!3m2!1spl!2spl!4v1746213428053!5m2!1spl!2spl" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>
    <script>
     // Uzyskanie elementów
const menuButton = document.querySelector('.menu');
const linki = document.querySelector('.linki');

// Obsługa kliknięcia na przycisk menu
menuButton.addEventListener('click', () => {
    linki.classList.toggle('show'); //pokazuje lub ukrywa menu
});
      </script>
</body>
</html>