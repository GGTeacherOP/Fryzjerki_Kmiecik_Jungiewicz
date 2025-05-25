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
      <li><a href="dni_wolne.php">dodaj dzien wolny</a></li>
      <li><a href="opinie-admin.php">Sprawdź opinie salonu</a></li>
      <li><a href="pracownicy-admin.php">Pracownicy</a></li>
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
    <li><a href="login.php">Umów swoją wizytę</a></li>    <?php
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
      <h2>Dodaj opinie o naszym salonie</h2><hr>
      <form action="" method="post" >
      <div class="gwiazdki">
  <input type="radio" id="star5" name="ocena" value="5">
  <label for="star5">&#9733;</label>
  
  <input type="radio" id="star4" name="ocena" value="4">
  <label for="star4">&#9733;</label>
  
  <input type="radio" id="star3" name="ocena" value="3">
  <label for="star3">&#9733;</label>
  
  <input type="radio" id="star2" name="ocena" value="2">
  <label for="star2">&#9733;</label>
  
  <input type="radio" id="star1" name="ocena" value="1">
  <label for="star1">&#9733;</label>
</div>
  
  <div>
    <textarea name="tresc" rows="4" placeholder="Napisz opinię..."></textarea>
  </div>
  
  <input type="submit" value="Wyślij opinię">
</form>
   
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
// Pobranie danych z formularza
    $ocena = 0;
    $tresc = "";
    if (isset($_POST['ocena'])) {
    $ocena = (int)$_POST['ocena'];
}

    if (isset($_POST['tresc'])) {
        $tresc = $_POST['tresc'];
}
    if ($ocena >= 1 && $ocena <= 5 && $tresc != "") {
        $id_usera = (int)$_SESSION['id'];
     $sql = "INSERT INTO `opinie`(`id`, `id_user`, `ocena`, `komentarz`, `data_opinii`) VALUES ('','$id_usera','$ocena','$tresc',CURDATE())";
     $wynik = mysqli_query($conn, $sql);
  if ($wynik) {
    echo "<!DOCTYPE html>
    <html lang='pl'>
    <head>
      <meta charset='UTF-8'>
      <title>Sukces</title>
      <script>
        // Przekierowanie po 3 sekundach
        setTimeout(function() {
          window.location.href = 'index.php';
        }, 3000);
      </script>
    </head>
    <body>
      <h2>Dziękujemy za Twoją opinię!</h2>
      <p>Za chwilę zostaniesz przekierowany do strony głównej...</p>
    </body>
    </html>";
} else {
    echo "Błąd przy zapisie: " . mysqli_error($conn);
}

} else {
echo "Proszę podać ocenę (1–5) i treść opinii.";
}
  mysqli_close($conn); // zamknięcie połączenia
}
?>
   
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