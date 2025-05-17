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
                  <li><a href="login.php">Logowanie</a></li>
                  <li><a href="rejestrowanie.php">Rejestracja</a></li>
                  <li><a href="login.php">Umów swoją wizytę</a></li>
              </ul>
          </nav>
      </div>
        <div class="header3">
            <img src="favicon.ico" alt="Logo Salonu Fryzjerskiego SigmaHair">
        </div>
    </header>
    <main class="main">
      <div class="o_salonie"> 
      <h2>O naszym salonie</h2>
      <p>Nasz salon fryzjerski to miejsce, gdzie pasja do pięknych włosów spotyka się z profesjonalizmem i dbałością o klienta. Zlokalizowany w Mielcu,
         nasz salon oferuje szeroki zakres usług fryzjerskich, dostosowanych do indywidualnych potrzeb i oczekiwań.</p>
         <h2>Nasi Fryzjerzy</h2>
         <p>Nasz zespół to wykwalifikowani i doświadczeni fryzjerzy, którzy nieustannie podnoszą swoje kwalifikacje, uczestnicząc w szkoleniach i śledząc najnowsze trendy.
           Zapewniamy indywidualne podejście do każdego klienta, doradzając i pomagając w doborze idealnej fryzury i koloru.</p>
           <h2>Atmosfera</h2>
           <p>W naszym salonie panuje przyjazna i relaksująca atmosfera. Dbamy o to, aby każdy klient czuł się u nas komfortowo i wyjątkowo.
             Oferujemy kawę, herbatę i miłą rozmowę, aby wizyta w naszym salonie była prawdziwą przyjemnością.</p>
             <h3>Zapraszamy do skorzystania z naszych usług i doświadczenia profesjonalnej obsługi w miłej atmosferze!</h3>
</div>
<hr>
<div id="opinie-container">
  <p id="tresc-opinii"></p>
  <p class="autor" id="autor-opinii"></p>
</div>

<?php
// Połączenie z bazą danych
$serwer = "localhost";
$user = "root";
$haslo = "";
$baza = "salon";

$conn = mysqli_connect($serwer, $user, $haslo, $baza);

if (!$conn) {
  die("Błąd połączenia: " . mysqli_connect_error());
}

// Pobieranie opinii z bazy
$komentarz = array();
$sql = "SELECT imie, komentarz FROM `widok_opinie`";
$wynik = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($wynik)) {
  $komentarz[] = $row;
}

mysqli_close($conn);

// Przekazanie opinii do JavaScript w formacie JSON
echo "<script>
var wszystkieOpinie = " . json_encode($komentarz) . ";
</script>";
?>

<script>
// Prosty skrypt do zmieniania opinii co 5 sekund
var indeks = 0;

function pokazOpinie() {
  if (wszystkieOpinie.length === 0) return;

  var opinia = wszystkieOpinie[indeks];
  document.getElementById('tresc-opinii').innerText = opinia.komentarz;
  document.getElementById('autor-opinii').innerText = '– ' + opinia.imie;

  // Przechodzimy do następnej opinii (w pętli)
  indeks = (indeks + 1) % wszystkieOpinie.length;
}

// Pokazujemy pierwszą opinię od razu
pokazOpinie();

// Co 5 sekund zmieniamy opinię
setInterval(pokazOpinie, 5000);
</script>
    </main>
    
    <section class="galeria_zdjec">
<h1>Zdjęcia naszego salonu i stylizacji</h1>
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
          <h1>Kontakt</h1><br>
          <ul class="kontakt">
            <li><h4>Aleksandra&nbspKmiecik</h4> <p>+48 999 888 777</p></li>
            <li><h4>Natalia&nbspJungiewicz</h4> <p>+48 666 555 444</p></li>
          </ul>
        </div>
        <div class="godziny_otwarcia">
          <h1>Godziny otwarcia</h1><br>
          <h4>pon-pt: 10:00-20:00</h4>
          <h4>sob-nd: 12:00-20:00</h4>
        </div>
        <div class="miejsce">
          <h1>Miejsce salonu</h1><br>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20393.138758562003!2d21.414070129394535!3d50.28927070553241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473d6b6c6d8b07ff%3A0x6bade516f8714a48!2zWmVzcMOzxYIgU3prw7PFgiBUZWNobmljem55Y2g!5e0!3m2!1spl!2spl!4v1746213428053!5m2!1spl!2spl" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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