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
     
      <h2>Umów sie na wizyte!</h2><hr>
      
<form method="post" action="umow.php">

    <label>Data wizyty:</label><br>
    <input type="date" name="data" required><br><br>

    <label>Godzina wizyty:</label><br>
    <input type="time" name="godzina" required><br><br>
    
    <label for="kod_rabatowy">Kod rabatowy (opcjonalnie):</label><br>
    <input type="text" name="kod_rabatowy" placeholder="Wpisz kod..."><br><br>

    <label for="usluga">Wybierz usługę:</label>
    
    <table>
        <?php
            $serwer="localhost";
            $user="root";
            $haslo="";
            $baza="salon";
            $conn=mysqli_connect($serwer,$user,$haslo,$baza);
            $kw1=("SELECT * FROM `uslugi`;");
            $skrypt1=mysqli_query($conn,$kw1);
            while($row=mysqli_fetch_row($skrypt1))
            {
                echo "<tr><td><input type='radio' id='".$row[1]."' name='usluga' value='".$row[0]."'>
                      <label for='".$row[1]."'>".$row[1]." - ".$row[2]."</td></tr></label>"; 
            }
           
            ?>
        </table>
        
    <label>Pracownik:</label><br>
    <select name="id_pracownika">
        <?php
        $conn=mysqli_connect($serwer,$user,$haslo,$baza);
            $kw2=("SELECT * FROM widok_pracownicy WHERE rola='fryzjer'");
            $skrypt2=mysqli_query($conn,$kw2);
            while($row=mysqli_fetch_row($skrypt2))
            {
                echo "<option value='{$row[0]} {$row[1]}'>{$row[0]} {$row[1]}</option>"; 
            }
         
        ?>
    </select><br><br>

    <button type="submit">Umów się</button>
</form>
    
      <?php
       $conn=mysqli_connect($serwer,$user,$haslo,$baza);
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $kod_rabatowy = isset($_POST['kod_rabatowy']) ? trim($_POST['kod_rabatowy']) : '';
        $znizka = 0;

    if (!empty($kod_rabatowy)) {
    $dzis = date('Y-m-d');
    $sql_kod = "SELECT znizka FROM kody_rabatowe 
                WHERE kod = '$kod_rabatowy' AND aktywny = 1 AND data_waznosci >= '$dzis'";
    $wynik_kod = mysqli_query($conn, $sql_kod);

    if (mysqli_num_rows($wynik_kod) > 0) {
        $rabat = mysqli_fetch_assoc($wynik_kod);
        $znizka = $rabat['znizka'];
        echo "<p style='color:green;'>Zastosowano kod rabatowy: -$znizka%</p>";
    } else {
        echo "<p style='color:red;'>Kod rabatowy jest nieprawidłowy lub wygasł.</p>";
    }
}


        $godzina = $_POST['godzina'];
      
        $id_usluga = $_POST['usluga'];
        $result_usluga = mysqli_query($conn, "SELECT czas_trwania FROM uslugi WHERE id = '$id_usluga'");
        $row_usluga = mysqli_fetch_assoc($result_usluga);
       // pobieranie id_uslugi z tabeli 

        $imie_nazwisko = $_POST['id_pracownika'];
        $id_pracownika = $_POST['id_pracownika'];
        $id_user = $_SESSION['id'];
        list($imie, $nazwisko) = explode(" ", $imie_nazwisko, 2); //dzielenie imienia i nazwiska
        $result_pracownik = mysqli_query($conn, "SELECT id FROM pracownicy WHERE imie = '$imie' AND nazwisko = '$nazwisko'");
        $row_pracownik = mysqli_fetch_assoc($result_pracownik);
        $id_pracownika = $row_pracownik['id']; //pobieranie id_pracownika


        $data = $_POST['data'];
        $start = $godzina;
        $wynik = mysqli_query($conn, "SELECT czas_trwania FROM uslugi WHERE id = $id_usluga");
        $wiersz = mysqli_fetch_assoc($wynik);
        $czas_trwania_time = $row_usluga['czas_trwania'];
        $parts = explode(":", $czas_trwania_time);
        $czas_trwania_minuty = $parts[0] * 60 + $parts[1];

        $end = date("H:i", strtotime($start) + $czas_trwania_minuty * 60);//pobieranie czasu

        $kw4 = mysqli_query($conn, "SELECT imie, nazwisko FROM pracownicy WHERE id = $id_pracownika");
        $p = mysqli_fetch_assoc($kw4);
        $imie = $p['imie'];
        $nazwisko = $p['nazwisko'];


/// Sprawdzenie daty
$dzis = date('Y-m-d');
if ($data < $dzis) {
    echo "<p style='color:red;'>Nie można zapisać się na wizytę w przeszłości!</p>";
    exit();
}

// Sprawdzenie dostępności pracownika
$sprawdz = mysqli_query($conn, "
    SELECT * FROM rezerwacje
    WHERE id_pracownika = '$id_pracownika'
      AND data_wizyty = '$data'
      AND (
          ('$start' < godzina_koncowa AND '$end' > godzina_poczatkowa)
      )
");
if (mysqli_num_rows($sprawdz) > 0){
    echo "Ten pracownik jest już zajęty w tym czasie!";
}else {
    // Zapisz rezerwację
    mysqli_query($conn, "INSERT INTO rezerwacje (id_user, id_usluga, id_pracownika, godzina_poczatkowa, godzina_koncowa, data_wizyty)
    VALUES ('$id_user', '$id_usluga', '$id_pracownika', '$start', '$end', '$data')");

    echo "Rezerwacja zapisana od $start do $end";
}
       }

?>

      <div id="podsumowanie" style="margin-top: 20px; font-weight: bold; color: #333;"></div>
      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 $conn=mysqli_connect($serwer,$user,$haslo,$baza);
$id_user = $_SESSION['id'];
$sprawdz_punkty = mysqli_query($conn, "SELECT * FROM program_lojalnosciowy WHERE id_user = $id_user");
$result_usluga = mysqli_query($conn, "SELECT cena FROM uslugi WHERE id = '$id_usluga'");
$row_cena = mysqli_fetch_assoc($result_usluga);
$cena = $row_cena['cena'];
$punkty = floor($cena / 10);
if (mysqli_num_rows($sprawdz_punkty) > 0) {
    // Jeśli istnieje - aktualizuje
    mysqli_query($conn, "UPDATE program_lojalnosciowy SET punkty = punkty + $punkty WHERE id_user = $id_user");
    echo "Zauktualizowano punkty" ;
} else {
    // Jeśli nie istnieje dodaje 
    mysqli_query($conn, "INSERT INTO program_lojalnosciowy (id_user, punkty) VALUES ($id_user, $punkty)");
    echo "Dodano punkty";

}}

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

      <script>
document.querySelector('form').addEventListener('change', function() {
    const data = document.querySelector('input[name="data"]').value;
    const uslugaInput = document.querySelector('input[name="usluga"]:checked');

    // sprawdza czy podano usluge 
    if (!data || !uslugaInput) {
        document.getElementById('podsumowanie').innerHTML = "";
        return;
    }

    // Pobieramy tekst 
    const uslugaLabel = uslugaInput.nextElementSibling.innerText;
    const [nazwaUslugi, cenaTekst] = uslugaLabel.split(" - ");
    const cena = parseFloat(cenaTekst.replace("zł", "").trim());

    // Obliczamy punkty
    const punkty = Math.floor(cena / 10);

    // Tworzymy tekst podsumowania
    const tekst = `
        <h3> Podsumowanie rezerwacji:</h3>
        <p> Data: <strong>${data}</strong></p>
        <p> Usługa: <strong>${nazwaUslugi}</strong></p>
        <p> Cena: <strong>${cena} zł</strong></p>
        <p> Punkty lojalnościowe: <strong>${punkty}</strong></p>
    `;

    
    document.getElementById('podsumowanie').innerHTML = tekst;

  
});
</script>

</body>
</html>