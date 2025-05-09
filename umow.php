<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet"  href="style.css">
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
    <main class="main">
      <div class="umow"> 
      <h2>umów sie na wizyte!</h2>
      
        
        <button type="submit">umów się na wizyte</button>
    </form>
      
      </div>
    </main>
    <section class="obok_main"></section>
    
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