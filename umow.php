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
                  <li><a href="login.php">Logowanie</a></li>
                  <li><a href="rejestrowanie.php">Rejestracja</a></li>
                  <li><a href="umow.php">Umów swoją wizytę</a></li>
              </ul>
          </nav>
      </div>
        <div class="header3">
            <img src="favicon.ico" alt="Logo Salonu Fryzjerskiego SigmaHair">
        </div>
    </header>
    <main class="cennik">
      <div class="umow"> 
      <h2>umów sie na wizyte!</h2>
      <form>
      <label for="imie">Imię i nazwisko:</label><br>
        <input type="text" id="imie" name="imie" required><br><br>

        <label for="email">Adres e-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefon">Numer telefonu:</label><br>
        <input type="tel" id="telefon" name="telefon" required><br><br>

        <label for="data">Data wizyty:</label><br>
        <input type="date" id="data" name="data" required><br><br>

        <label for="godzina">Godzina wizyty:</label><br>
        <input type="time" id="godzina" name="godzina" required><br><br>
        
        <label for="usluga">Wybierz usługę:</label>
    
        <select id="usluga" name="usluga" required>
        <option value="">-- Wybierz usługę --</option>
        <option value="Strzyżenie (z myciem i modelowaniem)">Strzyżenie (z myciem i modelowaniem) – 130 zł</option>
        <option value="Modelowanie (lokówka/prostownica)">Modelowanie (lokówka/prostownica) – 90 zł</option>
        <option value="Farbowanie odrostów">Farbowanie odrostów – 160 zł</option>
        <option value="Koloryzacja całościowa">Koloryzacja całościowa – 220 zł</option>
        <option value="Balayage / Ombre">Balayage / Ombre – 280 zł</option>
        <option value="Regeneracja włosów (sauna)">Regeneracja włosów (sauna) – 120 zł</option>
        <option value="Strzyżenie klasyczne">Strzyżenie klasyczne – 80 zł</option>
        <option value="Strzyżenie maszynką (całość)">Strzyżenie maszynką (całość) – 50 zł</option>
        <option value="Stylizacja brody">Stylizacja brody – 45 zł</option>
        <option value="Pakiet: włosy + broda">Pakiet: włosy + broda – 110 zł</option>
        <option value="Strzyżenie dziecięce">Strzyżenie dziecięce – 60 zł</option>
        <option value="Upięcie komunijne/okazjonalne">Upięcie komunijne/okazjonalne – 100 zł</option>
        <option value="Mycie z masażem skóry głowy">Mycie z masażem skóry głowy – 30 zł</option>
        <option value="Upięcie okazjonalne">Upięcie okazjonalne – 180 zł</option>
        <option value="Keratynowe prostowanie">Keratynowe prostowanie – 290 zł</option>
        <option value="Botox na włosy">Botox na włosy – 230 zł</option>
        <option value="Pakiet Ślubny VIP">Pakiet Ślubny VIP – 750 zł</option>
        <option value="Voucher 100 zł">Voucher o wartości 100 zł</option>
        <option value="Voucher 200 zł">Voucher o wartości 200 zł</option>
        <option value="Voucher 300 zł">Voucher o wartości 300 zł (z opakowaniem)</option>
    </select>
        
        <button type="submit">umów się na wizyte</button>
    </form>
      
      </div>
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