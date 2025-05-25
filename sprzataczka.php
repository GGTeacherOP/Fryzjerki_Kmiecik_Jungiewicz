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
    <main class="main">
      <table>
        <caption>Grafik pracy – Sprzątaczki (Salon Fryzjerski, 19–25 maja 2025)</caption>
        <thead>
            <tr>
                <th>Dzień</th>
                <th>Data</th>
                <th>Sprzątaczka 1<br><span class="name"></span></th>
                <th>Sprzątaczka 2<br><span class="name"></span></th>
                <th>Sprzątaczka 3<br><span class="name"></span></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Poniedziałek</td>
                <td>19.05.2025</td>
                <td>07:00–09:00<br>Poranne sprzątanie</td>
                <td>Wolne</td>
                <td>20:00–22:00<br>Dezynfekcja po zamknięciu</td>
            </tr>
            <tr>
                <td>Wtorek</td>
                <td>20.05.2025</td>
                <td>Wolne</td>
                <td>07:00–09:00<br>Podłogi, kurze</td>
                <td>20:00–22:00<br>Toalety, narzędzia</td>
            </tr>
            <tr>
                <td>Środa</td>
                <td>21.05.2025</td>
                <td>07:00–09:00<br>Ogólne sprzątanie</td>
                <td>20:00–22:00<br>Mycie luster</td>
                <td>Wolne</td>
            </tr>
            <tr>
                <td>Czwartek</td>
                <td>22.05.2025</td>
                <td>Wolne</td>
                <td>07:00–09:00<br>Przygotowanie salonu</td>
                <td>20:00–22:00<br>Dokładna dezynfekcja</td>
            </tr>
            <tr>
                <td>Piątek</td>
                <td>23.05.2025</td>
                <td>07:00–09:00<br>Ogólne porządki</td>
                <td>20:00–22:00<br>Uzupełnienie środków</td>
                <td>Wolne</td>
            </tr>
            <tr>
                <td>Sobota</td>
                <td>24.05.2025</td>
                <td>07:00–09:00<br>Szybkie porządki</td>
                <td>Wolne</td>
                <td>15:00–17:00<br>Sprzątanie po klientach</td>
            </tr>
            <tr>
                <td>Niedziela</td>
                <td>25.05.2025</td>
                <td colspan="3">Wolne (salon nieczynny)</td>
            </tr>
        </tbody>
    </table>

    </main>
    
    <section class="galeria_zdjec">
<h1>Zdjęcia naszego salonu i stylizacji</h1><hr>
<div class="galeria">
<img src="zdjecia/1.jpg" >
<img src="zdjecia/2.jpg" >
<img src="zdjecia/3.jpg" >
<img src="zdjecia/4.jpg" >
<img src="zdjecia/5.jpg" >
<img src="zdjecia/6.jpg" >
<img src="zdjecia/7.jpg"  alt="zdjecie salonu">
<img src="zdjecia/8.jpg" alt="zdjecie salonu" >
</div>
    </section>
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