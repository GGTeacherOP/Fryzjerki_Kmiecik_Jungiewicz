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
      <li><a href="zobacz-dni-wolne.php">Wyświetl dni wolne</a></li>
      <li><a href="opinie-admin.php">Sprawdź opinie salonu</a></li>
      <li><a href="pracownicy-szef.php">Pracownicy</a></li>
      <li><a href="uslugi-admin.php">Usługi</a></li>
      <li><a href="logout.php">Wyloguj się</a></li>
      <?php
    }elseif ($_SESSION['rola'] == "fryzjer") {
      ?>
      <li><a href="grafik-pracownik.php">Sprawdź grafik</a></li>
      <li><a href="dni_wolne.php">Dodaj dzien wolny</a></li>
      <li><a href="opinie-fryzjer.php">Sprawdź opinie salonu</a></li>
      <li><a href="uslugi-fryzjer.php">Usługi</a></li>
      <li><a href="logout.php">Wyloguj się</a></li>
    
      <?php
    }elseif ($_SESSION['rola'] == "admin") {
      ?>
      <li><a href="zobacz-dni-wolne.php">Wyświetl dni wolne</a></li>
      <li><a href="opinie-admin.php">Sprawdź opinie salonu</a></li>
      <li><a href="pracownicy-admin.php">Pracownicy</a></li>
      <li><a href="uslugi-admin.php">Usługi</a></li>
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
    <h2>Pracownicy</h2><hr>
<table>
    <tr class="tabelka_cennik">
        <th>ID pracownika</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Stanowisko</th>
        <th>Wynagrodzenie</th>
        <th>Usuń pracownika</th>
    </tr>

<?php
$serwer = "localhost";
$user = "root";
$haslo = "";
$baza = "salon";
$conn = mysqli_connect($serwer, $user, $haslo, $baza);

// Usuwanie pracownika (tylko z tabeli pracownicy, NIE z users!)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pracownika'])) {
    $id_pracownika = (int)$_POST['id_pracownika'];

    // Zmienia pracownika na nieaktywnego
    $ukryj = "UPDATE pracownicy SET aktywny = 0 WHERE id = $id_pracownika";
    mysqli_query($conn, $ukryj);
}

// Wyświetlanie danych z widoku
$zapytanie = "SELECT * FROM pracownicy_dane";
$wynik = mysqli_query($conn, $zapytanie);

while ($row = mysqli_fetch_row($wynik)) {
    echo "<tr>
        <td>$row[0]</td>  <!-- ID pracownika -->
        <td>$row[1]</td>  <!-- Imię -->
        <td>$row[2]</td>  <!-- Nazwisko -->
        <td>$row[3]</td>  <!-- Email -->
        <td>$row[4]</td>  <!-- Stanowisko -->
        <td>$row[5] zł</td>  <!-- Wynagrodzenie -->
        <td>
            <form method='POST' onsubmit=\"return confirm('Na pewno chcesz usunąć tego pracownika?');\">
                <input type='hidden' name='id_pracownika' value='$row[0]'>
                <input type='submit' value='Usuń'>
            </form>
        </td>
    </tr>";
}

mysqli_close($conn);
?>
        </table>
        <h3>Łączna liczba pracowników</h3><hr>
        <?php
            $serwer="localhost";
            $user="root";
            $haslo="";
            $baza="salon";
            $conn=mysqli_connect($serwer,$user,$haslo,$baza);
            $id_usera = (int)$_SESSION['id'];
            $kw1=("SELECT COUNT(*) FROM pracownicy_dane ");
            $skrypt1=mysqli_query($conn,$kw1);
            while($row=mysqli_fetch_row($skrypt1))
            {
                echo "<p>".$row[0]."
                </p>";

            }
          
            ?>
            <h2>Dodaj nowego pracownika</h2>
            <?php
$conn = mysqli_connect("localhost", "root", "", "salon");
if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['email']) &&
        !empty($_POST['haslo']) && !empty($_POST['id_stanowisko'])) {

        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $email = $_POST['email'];
        $haslo = $_POST['haslo'];
        $id_stanowisko = (int)$_POST['id_stanowisko'];

        // Sprawdzenie, czy email już istnieje
        $sprawdz_email = "SELECT id FROM users WHERE email = '$email'";
        $wynik_email = mysqli_query($conn, $sprawdz_email);
        
        if (mysqli_num_rows($wynik_email) > 0) {
            echo "Podany adres email jest już zajęty. Wybierz inny.";
        } else {
            // Dodaj pracownika
            $sql1 = "INSERT INTO pracownicy (imie, nazwisko, id_stanowisko) VALUES ('$imie', '$nazwisko', $id_stanowisko)";
            if (mysqli_query($conn, $sql1)) {
                $id_pracownika = mysqli_insert_id($conn);

                $result = mysqli_query($conn, "SELECT nazwa FROM stanowisko WHERE id = $id_stanowisko");
                $row = mysqli_fetch_assoc($result);
                $rola = $row['nazwa'];

                $sql2 = "INSERT INTO users (imie, nazwisko, email, haslo, rola, id_pracownika) 
                         VALUES ('$imie', '$nazwisko', '$email', '$haslo', '$rola', $id_pracownika)";

                if (mysqli_query($conn, $sql2)) {
                    echo "Dodano pracownika i użytkownika!";
                } else {
                    echo "Błąd dodawania użytkownika: " . mysqli_error($conn);
                }
            } else {
                echo "Błąd dodawania pracownika: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Wszystkie pola muszą być wypełnione!";
    }
}
?>

<!-- Formularz dodawania pracownika pokazujemy ZAWSZE, niezależnie czy był POST czy nie -->
<form method="POST">
    <label>Imię: <input type="text" name="imie" required></label><br>
    <label>Nazwisko: <input type="text" name="nazwisko" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Hasło: <input type="password" name="haslo" required></label><br>
    <label>Stanowisko:
        <select name="id_stanowisko" required>
            <option value="" disabled selected>Wybierz stanowisko</option>
            <?php
            $zapytanie = "SELECT id, nazwa FROM stanowisko";
            $wynik = mysqli_query($conn, $zapytanie);
            while ($row = mysqli_fetch_assoc($wynik)) {
                echo "<option value='{$row['id']}'>{$row['nazwa']}</option>";
            }
            mysqli_close($conn);
            ?>
        </select>
    </label><br><br>

    <input type="submit" value="Dodaj pracownika">
</form>

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