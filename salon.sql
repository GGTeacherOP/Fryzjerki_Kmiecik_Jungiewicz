-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 01, 2025 at 09:42 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dni_wolne`
--

CREATE TABLE `dni_wolne` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `data_wolna` date NOT NULL,
  `powod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dni_wolne`
--

INSERT INTO `dni_wolne` (`id`, `id_pracownika`, `data_wolna`, `powod`) VALUES
(1, 2, '2025-05-25', 'Urlop wypoczynkowy'),
(2, 5, '2025-05-26', 'Choroba'),
(3, 8, '2025-05-27', 'Szkolenie'),
(4, 12, '2025-05-28', 'Sprawy rodzinne');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `dni_wolne_admin`
-- (See below for the actual view)
--
CREATE TABLE `dni_wolne_admin` (
`imie` varchar(50)
,`nazwisko` varchar(50)
,`data_wolna` date
,`powod` varchar(255)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `dni_wolne_pracownik`
-- (See below for the actual view)
--
CREATE TABLE `dni_wolne_pracownik` (
`id_pracownika` int(11)
,`powod` varchar(255)
,`data_wolna` date
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `grafik_fryzjera`
-- (See below for the actual view)
--
CREATE TABLE `grafik_fryzjera` (
`id_user` int(11)
,`nazwa` varchar(100)
,`godzina_poczatkowa` time
,`godzina_koncowa` time
,`data_wizyty` date
,`id_pracownika` int(11)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_uslug`
--

CREATE TABLE `kategorie_uslug` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie_uslug`
--

INSERT INTO `kategorie_uslug` (`id`, `nazwa`) VALUES
(1, 'Usługi damskie'),
(2, 'Usługi męskie'),
(3, 'Usługi dla dzieci (do 12 lat)'),
(4, 'Usługi dodatkowe'),
(5, 'Pakiet ślubny'),
(6, 'Vouchery');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kody_rabatowe`
--

CREATE TABLE `kody_rabatowe` (
  `id` int(11) NOT NULL,
  `kod` varchar(50) NOT NULL,
  `znizka` decimal(5,2) NOT NULL,
  `data_waznosci` date NOT NULL,
  `aktywny` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kody_rabatowe`
--

INSERT INTO `kody_rabatowe` (`id`, `kod`, `znizka`, `data_waznosci`, `aktywny`) VALUES
(1, 'WIOSNA15', 15.00, '2025-06-30', 1),
(2, 'LATO10', 10.00, '2025-08-31', 1),
(3, 'ZIMA20', 20.00, '2025-12-31', 0);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `logowanie_aktywny`
-- (See below for the actual view)
--
CREATE TABLE `logowanie_aktywny` (
`id` int(11)
,`imie` varchar(50)
,`nazwisko` varchar(50)
,`email` varchar(100)
,`haslo` varchar(255)
,`rola` enum('klient','szef','fryzjer','sprzataczka','admin')
,`id_pracownika` int(11)
,`aktywny` tinyint(1)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `moje_rezerwacje`
-- (See below for the actual view)
--
CREATE TABLE `moje_rezerwacje` (
`id_user` int(11)
,`nazwa` varchar(100)
,`godzina_poczatkowa` time
,`godzina_koncowa` time
,`data_wizyty` date
,`imie_stylisty` varchar(50)
,`nazwisko_stylisty` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opinie`
--

CREATE TABLE `opinie` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ocena` int(11) DEFAULT NULL CHECK (`ocena` between 1 and 5),
  `komentarz` text DEFAULT NULL,
  `data_opinii` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opinie`
--

INSERT INTO `opinie` (`id`, `id_user`, `ocena`, `komentarz`, `data_opinii`) VALUES
(1, 1, 5, 'Świetne strzyżenie, bardzo polecam!', '2025-05-21'),
(3, 3, 3, 'Usługa ok, ale mogłoby być szybciej.', '2025-05-23'),
(12, 1, 4, 'Bardzo przyjemne doświadczenie. Strzyżenie szybkie i dokładne, a do tego pyszna kawa w poczekalni. Lekki minus za opóźnienie 10 minut, ale rekompensuje to jakość usługi.', '2025-05-25'),
(13, 2, 5, 'Najlepszy salon, w jakim byłam! Fryzjerka doskonale zrozumiała, czego oczekuję, a efekt końcowy przerósł moje oczekiwania. Miła atmosfera, profesjonalna obsługa. Na pewno wrócę!', '2025-05-25'),
(14, 3, 5, 'Strzyżenie brody i włosów na 5+. Wyszedłem z salonu wyglądając jak człowiek. Świetna atmosfera, fajna muzyka, a do tego fotel masujący – bajka.', '2025-05-25'),
(15, 51, 5, 'Luz i pełna profeska. Fryzjer doradził, co będzie pasowało do mojego kształtu twarzy, i miał rację – dziewczyna była zachwycona. Dzięki!', '2025-05-25');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `opinie_admin`
-- (See below for the actual view)
--
CREATE TABLE `opinie_admin` (
`id_opini` int(11)
,`id_user` int(11)
,`komentarz` text
,`ocena` int(11)
,`data_opinii` date
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `id_stanowisko` int(11) DEFAULT NULL,
  `aktywny` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`id`, `imie`, `nazwisko`, `id_stanowisko`, `aktywny`) VALUES
(1, 'Jan', 'Kowalski', 1, 0),
(2, 'Anna', 'Nowak', 2, 1),
(3, 'Piotr', 'Wiśniewski', 2, 1),
(4, 'Katarzyna', 'Wójcik', 2, 1),
(5, 'Michał', 'Krawczyk', 2, 1),
(6, 'Ewa', 'Zielińska', 2, 1),
(7, 'Tomasz', 'Sikora', 2, 1),
(8, 'Agnieszka', 'Lewandowska', 3, 0),
(9, 'Marcin', 'Duda', 3, 0),
(10, 'Magdalena', 'Kaczmarek', 3, 1),
(11, 'Robert', 'Mazur', 3, 0),
(12, 'Joanna', 'Kowalczyk', 3, 1),
(13, 'Łukasz', 'Baran', 3, 1),
(14, 'Monika', 'Szymańska', 3, 1),
(15, 'Paweł', 'Włodarczyk', 3, 1),
(24, 'Natalia', 'Jungiewicz', 1, 1),
(25, 'Aleksandra', 'Kmiecik', 1, 1),
(26, 'Natalia', 'Jungiewicz', 1, 1),
(27, 'Andrzej', 'Pusty', 2, 1),
(29, 'Artur', 'Smok', 4, 1);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `pracownicy_dane`
-- (See below for the actual view)
--
CREATE TABLE `pracownicy_dane` (
`id_pracownika` int(11)
,`imie` varchar(50)
,`nazwisko` varchar(50)
,`email` varchar(100)
,`nazwa` varchar(50)
,`wynagrodzenie` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `program_lojalnosciowy`
--

CREATE TABLE `program_lojalnosciowy` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `punkty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_lojalnosciowy`
--

INSERT INTO `program_lojalnosciowy` (`id`, `id_user`, `punkty`) VALUES
(1, 1, 653),
(2, 2, 300),
(3, 3, 75),
(4, 4, 200),
(7, 51, 4),
(8, 52, 16);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `punkty`
-- (See below for the actual view)
--
CREATE TABLE `punkty` (
`id_user` int(11)
,`punkty` int(11)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_usluga` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `godzina_poczatkowa` time NOT NULL,
  `godzina_koncowa` time NOT NULL,
  `data_wizyty` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezerwacje`
--

INSERT INTO `rezerwacje` (`id`, `id_user`, `id_usluga`, `id_pracownika`, `godzina_poczatkowa`, `godzina_koncowa`, `data_wizyty`) VALUES
(1, 1, 1, 4, '10:00:00', '11:00:00', '2025-05-20'),
(2, 2, 4, 2, '12:00:00', '14:00:00', '2025-05-21'),
(3, 3, 10, 5, '09:00:00', '09:45:00', '2025-05-22'),
(4, 4, 15, 6, '13:00:00', '14:30:00', '2025-05-23'),
(8, 51, 9, 3, '15:00:00', '15:20:00', '2025-05-31'),
(9, 52, 3, 2, '13:00:00', '14:30:00', '2025-05-28'),
(10, 1, 1, 2, '20:15:00', '21:15:00', '2025-06-21'),
(25, 1, 1, 2, '10:00:00', '11:00:00', '2025-06-03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stanowisko`
--

CREATE TABLE `stanowisko` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `wynagrodzenie` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stanowisko`
--

INSERT INTO `stanowisko` (`id`, `nazwa`, `wynagrodzenie`) VALUES
(1, 'szef', 8000.00),
(2, 'fryzjer', 3500.00),
(3, 'sprzataczka', 2500.00),
(4, 'admin', 4500.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkolenia_pracownikow`
--

CREATE TABLE `szkolenia_pracownikow` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `temat` varchar(100) NOT NULL,
  `data_szkolenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `szkolenia_pracownikow`
--

INSERT INTO `szkolenia_pracownikow` (`id`, `id_pracownika`, `temat`, `data_szkolenia`) VALUES
(1, 2, 'Nowe techniki koloryzacji', '2025-05-10'),
(2, 6, 'Obsługa klienta', '2025-05-15'),
(3, 9, 'Bezpieczeństwo i higiena pracy', '2025-05-12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `rola` enum('klient','szef','fryzjer','sprzataczka','admin') NOT NULL,
  `id_pracownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `imie`, `nazwisko`, `email`, `haslo`, `rola`, `id_pracownika`) VALUES
(1, 'Adam', 'Kowal', 'adam.kowal@example.com', 'adam1234', 'klient', NULL),
(2, 'Barbara', 'Nowicka', 'barbara.nowicka@example.com', 'barbara2025', 'klient', NULL),
(3, 'Cezary', 'Lewandowski', 'cezary.lewandowski@example.com', 'cezarypass', 'klient', NULL),
(4, 'Dorota', 'Majewska', 'dorota.majewska@example.com', 'dorota321', 'klient', NULL),
(16, 'Jan', 'Kowalski', 'jan.kowalski@example.com', 'szef123', 'szef', 1),
(17, 'Anna', 'Nowak', 'anna.nowak@example.com', 'fryzjerka1', 'fryzjer', 2),
(18, 'Piotr', 'Wiśniewski', 'piotr.wisniewski@example.com', 'fryzjerpiotr', 'fryzjer', 3),
(19, 'Katarzyna', 'Wójcik', 'katarzyna.wojcik@example.com', 'kasia2025', 'fryzjer', 4),
(23, 'Agnieszka', 'Lewandowska', 'agnieszka.lewandowska@example.com', 'sprzatanie1', 'sprzataczka', 8),
(24, 'Marcin', 'Duda', 'marcin.duda@example.com', 'sprzatanie2', 'sprzataczka', 9),
(51, 'Edward', 'Polak', 'epolak@email.com', 'polake123', 'klient', NULL),
(52, 'Ewelina', 'Bratek', 'bratekk@mail.pl', 'bratek1', 'klient', NULL),
(53, 'Aleksandra', 'Kmiecik', 'kmiecika@szef.pl', 'szef2', 'szef', 25),
(54, 'Natalia', 'Jungiewicz', 'jungiewicz@szef.pl', 'szef3', 'szef', 26),
(55, 'Andrzej', 'Pusty', 'apusty@salon.com', 'pustyy', 'fryzjer', 27),
(57, 'Artur', 'Smok', 'asmok@mailadmin.pl', 'smook1', 'admin', 29);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uslugi`
--

CREATE TABLE `uslugi` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `czas_trwania` time NOT NULL,
  `id_kategorii` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uslugi`
--

INSERT INTO `uslugi` (`id`, `nazwa`, `cena`, `czas_trwania`, `id_kategorii`) VALUES
(1, 'Strzyżenie (z myciem i modelowaniem)', 130.00, '01:00:00', 1),
(2, 'Modelowanie (lokówka/prostownica)', 90.00, '00:45:00', 1),
(3, 'Farbowanie odrostów', 160.00, '01:30:00', 1),
(4, 'Koloryzacja całościowa', 220.00, '02:00:00', 1),
(6, 'Regeneracja włosów (sauna)', 120.00, '01:00:00', 1),
(7, 'Strzyżenie klasyczne', 80.00, '00:30:00', 2),
(8, 'Strzyżenie maszynką (całość)', 50.00, '00:20:00', 2),
(9, 'Stylizacja brody', 45.00, '00:20:00', 2),
(10, 'Pakiet: włosy + broda', 110.00, '00:45:00', 2),
(11, 'Strzyżenie dziecięce', 60.00, '00:30:00', 3),
(12, 'Upięcie komunijne/okazjonalne', 100.00, '01:00:00', 3),
(13, 'Mycie z masażem skóry głowy', 30.00, '00:15:00', 4),
(14, 'Upięcie okazjonalne', 180.00, '01:30:00', 4),
(15, 'Keratynowe prostowanie', 290.00, '02:30:00', 4),
(16, 'Botox na włosy', 230.00, '02:00:00', 4),
(17, 'Pakiet całodniowy – Ślubny VIP', 750.00, '08:00:00', 5),
(18, 'Voucher o wartości 100 zł', 100.00, '00:00:00', 6),
(19, 'Voucher o wartości 200 zł', 200.00, '00:00:00', 6);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `uslugi_admin`
-- (See below for the actual view)
--
CREATE TABLE `uslugi_admin` (
`id_uslugi` int(11)
,`nazwa` varchar(100)
,`cena` decimal(10,2)
,`czas_trwania` time
,`kategoria` varchar(100)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_logowanie`
-- (See below for the actual view)
--
CREATE TABLE `widok_logowanie` (
`rola` enum('klient','szef','fryzjer','sprzataczka','admin')
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_opinie`
-- (See below for the actual view)
--
CREATE TABLE `widok_opinie` (
`imie` varchar(50)
,`komentarz` text
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_pracownicy`
-- (See below for the actual view)
--
CREATE TABLE `widok_pracownicy` (
`imie` varchar(50)
,`nazwisko` varchar(50)
,`rola` enum('klient','szef','fryzjer','sprzataczka','admin')
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_uslugi_kategorie`
-- (See below for the actual view)
--
CREATE TABLE `widok_uslugi_kategorie` (
`nazwa_kategorii` varchar(100)
,`nazwa_uslugi` varchar(100)
,`cena` decimal(10,2)
,`czas_trwania` time
);

-- --------------------------------------------------------

--
-- Struktura widoku `dni_wolne_admin`
--
DROP TABLE IF EXISTS `dni_wolne_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dni_wolne_admin`  AS SELECT `pracownicy`.`imie` AS `imie`, `pracownicy`.`nazwisko` AS `nazwisko`, `dni_wolne`.`data_wolna` AS `data_wolna`, `dni_wolne`.`powod` AS `powod` FROM (`dni_wolne` join `pracownicy` on(`pracownicy`.`id` = `dni_wolne`.`id_pracownika`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `dni_wolne_pracownik`
--
DROP TABLE IF EXISTS `dni_wolne_pracownik`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dni_wolne_pracownik`  AS SELECT `dni_wolne`.`id_pracownika` AS `id_pracownika`, `dni_wolne`.`powod` AS `powod`, `dni_wolne`.`data_wolna` AS `data_wolna` FROM (`dni_wolne` join `pracownicy` on(`pracownicy`.`id` = `dni_wolne`.`id_pracownika`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `grafik_fryzjera`
--
DROP TABLE IF EXISTS `grafik_fryzjera`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `grafik_fryzjera`  AS SELECT `rezerwacje`.`id_user` AS `id_user`, `uslugi`.`nazwa` AS `nazwa`, `rezerwacje`.`godzina_poczatkowa` AS `godzina_poczatkowa`, `rezerwacje`.`godzina_koncowa` AS `godzina_koncowa`, `rezerwacje`.`data_wizyty` AS `data_wizyty`, `pracownicy`.`id` AS `id_pracownika` FROM ((`rezerwacje` join `uslugi` on(`uslugi`.`id` = `rezerwacje`.`id_usluga`)) join `pracownicy` on(`pracownicy`.`id` = `rezerwacje`.`id_pracownika`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `logowanie_aktywny`
--
DROP TABLE IF EXISTS `logowanie_aktywny`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `logowanie_aktywny`  AS SELECT `users`.`id` AS `id`, `users`.`imie` AS `imie`, `users`.`nazwisko` AS `nazwisko`, `users`.`email` AS `email`, `users`.`haslo` AS `haslo`, `users`.`rola` AS `rola`, `users`.`id_pracownika` AS `id_pracownika`, `pracownicy`.`aktywny` AS `aktywny` FROM (`users` join `pracownicy` on(`pracownicy`.`id` = `users`.`id_pracownika`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `moje_rezerwacje`
--
DROP TABLE IF EXISTS `moje_rezerwacje`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `moje_rezerwacje`  AS SELECT `rezerwacje`.`id_user` AS `id_user`, `uslugi`.`nazwa` AS `nazwa`, `rezerwacje`.`godzina_poczatkowa` AS `godzina_poczatkowa`, `rezerwacje`.`godzina_koncowa` AS `godzina_koncowa`, `rezerwacje`.`data_wizyty` AS `data_wizyty`, `pracownicy`.`imie` AS `imie_stylisty`, `pracownicy`.`nazwisko` AS `nazwisko_stylisty` FROM ((`rezerwacje` join `uslugi` on(`uslugi`.`id` = `rezerwacje`.`id_usluga`)) join `pracownicy` on(`pracownicy`.`id` = `rezerwacje`.`id_pracownika`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `opinie_admin`
--
DROP TABLE IF EXISTS `opinie_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `opinie_admin`  AS SELECT `opinie`.`id` AS `id_opini`, `opinie`.`id_user` AS `id_user`, `opinie`.`komentarz` AS `komentarz`, `opinie`.`ocena` AS `ocena`, `opinie`.`data_opinii` AS `data_opinii` FROM `opinie` ;

-- --------------------------------------------------------

--
-- Struktura widoku `pracownicy_dane`
--
DROP TABLE IF EXISTS `pracownicy_dane`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pracownicy_dane`  AS SELECT `pracownicy`.`id` AS `id_pracownika`, `pracownicy`.`imie` AS `imie`, `pracownicy`.`nazwisko` AS `nazwisko`, `users`.`email` AS `email`, `stanowisko`.`nazwa` AS `nazwa`, `stanowisko`.`wynagrodzenie` AS `wynagrodzenie` FROM ((`pracownicy` join `users` on(`pracownicy`.`id` = `users`.`id_pracownika`)) join `stanowisko` on(`stanowisko`.`id` = `pracownicy`.`id_stanowisko`)) WHERE `pracownicy`.`aktywny` = 1 ;

-- --------------------------------------------------------

--
-- Struktura widoku `punkty`
--
DROP TABLE IF EXISTS `punkty`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `punkty`  AS SELECT `program_lojalnosciowy`.`id_user` AS `id_user`, `program_lojalnosciowy`.`punkty` AS `punkty` FROM `program_lojalnosciowy` ;

-- --------------------------------------------------------

--
-- Struktura widoku `uslugi_admin`
--
DROP TABLE IF EXISTS `uslugi_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `uslugi_admin`  AS SELECT `uslugi`.`id` AS `id_uslugi`, `uslugi`.`nazwa` AS `nazwa`, `uslugi`.`cena` AS `cena`, `uslugi`.`czas_trwania` AS `czas_trwania`, `kategorie_uslug`.`nazwa` AS `kategoria` FROM (`uslugi` join `kategorie_uslug` on(`kategorie_uslug`.`id` = `uslugi`.`id_kategorii`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_logowanie`
--
DROP TABLE IF EXISTS `widok_logowanie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_logowanie`  AS SELECT DISTINCT `users`.`rola` AS `rola` FROM `users` ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_opinie`
--
DROP TABLE IF EXISTS `widok_opinie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_opinie`  AS SELECT `users`.`imie` AS `imie`, `opinie`.`komentarz` AS `komentarz` FROM (`opinie` join `users` on(`users`.`id` = `opinie`.`id_user`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_pracownicy`
--
DROP TABLE IF EXISTS `widok_pracownicy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_pracownicy`  AS SELECT `pracownicy`.`imie` AS `imie`, `pracownicy`.`nazwisko` AS `nazwisko`, `users`.`rola` AS `rola` FROM (`pracownicy` join `users`) WHERE `pracownicy`.`id` = `users`.`id_pracownika` ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_uslugi_kategorie`
--
DROP TABLE IF EXISTS `widok_uslugi_kategorie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_uslugi_kategorie`  AS SELECT `kategorie_uslug`.`nazwa` AS `nazwa_kategorii`, `uslugi`.`nazwa` AS `nazwa_uslugi`, `uslugi`.`cena` AS `cena`, `uslugi`.`czas_trwania` AS `czas_trwania` FROM (`uslugi` join `kategorie_uslug` on(`kategorie_uslug`.`id` = `uslugi`.`id_kategorii`)) ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dni_wolne`
--
ALTER TABLE `dni_wolne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `kategorie_uslug`
--
ALTER TABLE `kategorie_uslug`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kody_rabatowe`
--
ALTER TABLE `kody_rabatowe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indeksy dla tabeli `opinie`
--
ALTER TABLE `opinie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stanowisko` (`id_stanowisko`);

--
-- Indeksy dla tabeli `program_lojalnosciowy`
--
ALTER TABLE `program_lojalnosciowy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_usluga` (`id_usluga`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `stanowisko`
--
ALTER TABLE `stanowisko`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `szkolenia_pracownikow`
--
ALTER TABLE `szkolenia_pracownikow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uslugi_id_kategorii` (`id_kategorii`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dni_wolne`
--
ALTER TABLE `dni_wolne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategorie_uslug`
--
ALTER TABLE `kategorie_uslug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kody_rabatowe`
--
ALTER TABLE `kody_rabatowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `opinie`
--
ALTER TABLE `opinie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `program_lojalnosciowy`
--
ALTER TABLE `program_lojalnosciowy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stanowisko`
--
ALTER TABLE `stanowisko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `szkolenia_pracownikow`
--
ALTER TABLE `szkolenia_pracownikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dni_wolne`
--
ALTER TABLE `dni_wolne`
  ADD CONSTRAINT `fk_dni_wolne_pracownik` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `opinie`
--
ALTER TABLE `opinie`
  ADD CONSTRAINT `fk_opinie_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD CONSTRAINT `fk_pracownik_stanowisko` FOREIGN KEY (`id_stanowisko`) REFERENCES `stanowisko` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `program_lojalnosciowy`
--
ALTER TABLE `program_lojalnosciowy`
  ADD CONSTRAINT `fk_lojalka_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `fk_rezerwacje_pracownik` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rezerwacje_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rezerwacje_usluga` FOREIGN KEY (`id_usluga`) REFERENCES `uslugi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `szkolenia_pracownikow`
--
ALTER TABLE `szkolenia_pracownikow`
  ADD CONSTRAINT `szkolenia_pracownikow_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_pracownik` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `uslugi`
--
ALTER TABLE `uslugi`
  ADD CONSTRAINT `fk_uslugi_kategoria` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie_uslug` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
