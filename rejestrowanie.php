<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="icon"  href="zdjecia/favicon.png">
</head>
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
      <div class="rejestrowanie"> 
      <h1>Zarejestruj sie!</h1>
      <form action="" method="post" onsubmit="return checkPasswords()">
      <label for="imie">Imię:</label>
        <input type="text" id="imie" name="imie" placeholder="podaj swoje imię"  required>
        <br><br>
        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko" placeholder="podaj swoje nazwisko"  required>
        <br><br>
        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" placeholder="podaj email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        <br><br>
        
        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" placeholder="podaj haslo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        <br><br>
        <label for="phaslo">Powtórz hasło:</label>
        <input type="password" id="phaslo" name="phaslo" placeholder="powtórz hasło" required>
        <br><br>
       
        
        <button type="submit" >Zarejstruj sie</button>
    </form>
    <script>
// Funkcja, która sprawdza, czy pola 'haslo' i 'phaslo' są identyczne
function checkPasswords() {
  
  // Pobieramy wartości obu pól
  var password1 = document.getElementById('haslo').value;
  var password2 = document.getElementById('phaslo').value;

  // Porównujemy hasła
  if (password1 !== password2) {
    // Jeśli się różnią, pokazujemy alert i zatrzymujemy wysyłanie formularza
    alert("Hasła nie są takie same! Wprowadź takie same hasła.");
    return false; // formularz nie zostanie wysłany
  }

  // Jeśli hasła są identyczne, formularz zostanie wysłany
  return true;
}
</script>
<?php
// Jeśli dane zostały przesłane metodą POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           $serwer="localhost";
            $user="root";
            $haslo="";
            $baza="salon";
            $conn=mysqli_connect($serwer,$user,$haslo,$baza);

  // Sprawdzenie połączenia
  if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
  }
  // Pobranie hasła z formularza
  $imie=$_POST['imie'];
  $nazwisko=$_POST['nazwisko'];
  $email=$_POST['email'];
  $haslo = $_POST['haslo'];
  // Sprawdzamy czy e-mail już istnieje
  $sql_sprawdz = "SELECT * FROM users WHERE email = '$email'";
  $wynik = mysqli_query($conn, $sql_sprawdz);

  if (mysqli_num_rows($wynik) > 0) {
    echo "Ten e-mail jest już zarejestrowany. Zaloguj się!";
    header("Location: login.php");
  exit();
  }
  // Zapytanie do bazy – dodanie nowego użytkownika
  $sql = "INSERT INTO `users`(`id`, `imie`, `nazwisko`, `email`, `haslo`, `rola`) VALUES ('','$imie','$nazwisko','$email','$haslo','klient');";

  if (mysqli_query($conn, $sql)) {
      // Komunikat o sukcesie i przekierowanie po 3 sekundach
  echo "<!DOCTYPE html>
  <html lang='pl'>
  <head>
    <meta charset='UTF-8'>
    <title>Sukces</title>
    <script>
      // Przekierowanie po 3 sekundach
      setTimeout(function() {
        window.location.href = 'login.php';
      }, 3000);
    </script>
  </head>
  <body>
    <h2>Rejestracja zakończona sukcesem!</h2>
    <p>Za chwilę zostaniesz przekierowany do strony logowania...</p>
  </body>
  </html>";

  } else {
    echo "Błąd: " . mysqli_error($conn);
  }

  mysqli_close($conn); // zamknięcie połączenia
}
?>
      
      </div>
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