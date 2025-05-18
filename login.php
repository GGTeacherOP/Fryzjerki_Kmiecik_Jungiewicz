<?php
session_start();

// Jeśli już zalogowany, przekieruj do odpowiedniej strony
if (isset($_SESSION['id'])) {
    if ($_SESSION['rola'] == 'klient') {
        header("Location: umow.php");
        exit();
    } elseif ($_SESSION['rola'] == 'fryzjer') {
        header("Location: panel_fryzjera.php");
        exit();
    } elseif ($_SESSION['rola'] == 'szef') {
        header("Location: index.php");
        exit();
    }elseif ($_SESSION['rola'] == 'sprzataczka') {
      header("Location: panel_sprzataczki.php");
      exit();
  }
}

// obsługiwanie logowanie po wysłaniu formularza
if (isset($_POST['zaloguj'])) {
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];
    $rola = $_POST['rola'];

    $conn = mysqli_connect("localhost", "root", "", "salon");
    if (!$conn) {
        die("Błąd połączenia: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE email='$email' AND haslo='$haslo' AND rola='$rola'";
    $wynik = mysqli_query($conn, $sql);

    if (mysqli_num_rows($wynik) == 1) {
        $dane = mysqli_fetch_assoc($wynik);
        $_SESSION['id'] = $dane['id'];
        $_SESSION['email'] = $dane['email'];
        $_SESSION['rola'] = $dane['rola'];
        if (isset($_POST['zapamietaj']) && $_POST['zapamietaj'] == '1') {
          // Ustawienie cookie sesji na 7 dni
          setcookie(session_name(), session_id(), time() + (7 * 24 * 60 * 60), "/");
      }
        if ($rola == "klient") {
            header("Location: umow.php");
        } elseif ($rola == "fryzjer") {
            header("Location: panel_fryzjera.php");
        } elseif ($rola == "szef") {
            header("Location: index.php");
        }elseif ($rola == "sprzataczka") {
          header("Location: panel_sprzataczki.php");
      }
        exit();
    } else {
        $blad = "Nieprawidłowe dane logowania.";
    }

    mysqli_close($conn);
}
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
    } elseif ($_SESSION['rola'] == "admin") {
      ?>
      <li><a href="sprawdz_rezerwacje.php">Sprawdź rezerwacje</a></li>
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
      <div class="logowanie"> 
      <h1>Zaloguj sie!</h1>
      <form action="" method="post">
        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" placeholder="podaj email"  required>
        <br><br>
        
        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" placeholder="podaj haslo" required>
        <br><br>
        
        <label for="rola">Kim jestes?</label>
        <select id="rola" name="rola" >
           <?php
            $serwer="localhost";
            $user="root";
            $haslo="";
            $baza="salon";
            $conn=mysqli_connect($serwer,$user,$haslo,$baza);
            $kw1=("SELECT rola FROM `widok_logowanie`");
            $skrypt1=mysqli_query($conn,$kw1);
            while($row=mysqli_fetch_row($skrypt1))
            {
                echo "<option id=".$row[0]." name=".$row[0]." value=".$row[0].">".$row[0]."</option>"; 
            }
            mysqli_close($conn);
            ?>
           
        </select>
        <br><br>
        <label>
  <input type="checkbox" name="zapamietaj" value="1"> Zapamiętaj mnie</label><br><br>
        <button type="submit" name="zaloguj">Zaloguj się</button>
        
    </form>
    <?php if (isset($blad)) echo "<p style='color:red;'>$blad</p>"; ?>
      
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