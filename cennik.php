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
                  <li><a href="rejestrowanie.php">Umów swoją wizytę</a></li>
              </ul>
          </nav>
      </div>
        <div class="header3">
            <img src="favicon.ico" alt="Logo Salonu Fryzjerskiego SigmaHair">
        </div>
    </header>
    <main class="cennik">
      <h2>Cennik</h2>
      <table>
    <!-- USŁUGI DAMSKIE -->
    <tr class="tabelka_cennik">
      <td >Usługi damskie</td>
      <td>Cena</td>
    </tr>
    <tr><td>Strzyżenie (z myciem i modelowaniem)</td><td>130 zł</td></tr>
    <tr><td>Modelowanie (lokówka/prostownica)</td><td>90 zł</td></tr>
    <tr><td>Farbowanie odrostów</td><td>160 zł</td></tr>
    <tr><td>Koloryzacja całościowa</td><td>220 zł</td></tr>
    <tr><td>Balayage / Ombre</td><td>280 zł</td></tr>
    <tr><td>Regeneracja włosów (sauna)</td><td>120 zł</td></tr>

    <!-- USŁUGI MĘSKIE -->
    <tr class="tabelka_cennik">
      <td >Usługi męskie</td>
      <td >Cena</td>
    </tr>
    <tr><td>Strzyżenie klasyczne</td><td>80 zł</td></tr>
    <tr><td>Strzyżenie maszynką (całość)</td><td>50 zł</td></tr>
    <tr><td>Stylizacja brody</td><td>45 zł</td></tr>
    <tr><td>Pakiet: włosy + broda</td><td>110 zł</td></tr>

    <!-- USŁUGI DLA DZIECI -->
    <tr class="tabelka_cennik">
      <td >Usługi dla dzieci (do 12 lat)</td>
      <td >Cena</td>
    </tr>
    <tr><td>Strzyżenie dziecięce</td><td>60 zł</td></tr>
    <tr><td>Upięcie komunijne/okazjonalne</td><td>100 zł</td></tr>

    <!-- USŁUGI DODATKOWE -->
    <tr class="tabelka_cennik">
      <td >Usługi dodatkowe</td>
      <td >Cena</td>
    </tr>
    <tr><td>Mycie z masażem skóry głowy</td><td>30 zł</td></tr>
    <tr><td>Upięcie okazjonalne</td><td>180 zł</td></tr>
    <tr><td>Keratynowe prostowanie</td><td>290 zł</td></tr>
    <tr><td>Botox na włosy</td><td>230 zł</td></tr>

    <!-- PAKIET ŚLUBNY -->
    <tr class="tabelka_cennik">
      <td>Pakiet całodniowy – Ślubny VIP</td>
      <td>Cena za pakiet</td>
    </tr>
    <tr><td>
      • Konsultacja + próbna fryzura<br>
      • Fryzura ślubna w dniu ceremonii<br>
      • Stylizacja dla świadkowej/mamy<br>
      • (opcjonalnie) makijaż dzienny/ślubny<br>
      • Obecność stylistki do 16:00
    </td>
    <td>750 zł</td></tr>

    <!-- VOUCHERY -->
    <tr class="tabelka_cennik">
      <td >Vouchery podarunkowe</td>
      <td >Cena</td>
    </tr>
    <tr><td>Voucher o wartości 100 zł</td><td>100 zł</td></tr>
    <tr><td>Voucher o wartości 200 zł</td><td>200 zł</td></tr>
    <tr><td>Voucher o wartości 300 zł (z opakowaniem)</td><td>300 zł</td></tr>
  </table>


       </main>
    
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