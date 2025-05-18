-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 18, 2025 at 03:47 PM
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
(5, 5, 20, 0, '11:00:00', '11:30:00', '2025-05-24');

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
  `rola` enum('klient','szef','fryzjer','sprzataczka') NOT NULL,
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
(5, 'Eryk', 'Sadowski', 'eryk.sadowski@example.com', 'erik2025', 'klient', NULL),
(6, 'Felicja', 'Czajka', 'felicja.czajka@example.com', 'felicja!', 'klient', NULL),
(7, 'Grzegorz', 'Walczak', 'grzegorz.walczak@example.com', 'grzesiek', 'klient', NULL),
(8, 'Halina', 'Bąk', 'halina.bak@example.com', 'halina2025', 'klient', NULL),
(9, 'Igor', 'Gajda', 'igor.gajda@example.com', 'igorpass', 'klient', NULL),
(10, 'Justyna', 'Pawlak', 'justyna.pawlak@example.com', 'justyna123', 'klient', NULL),
(11, 'Kamil', 'Sobczak', 'kamil.sobczak@example.com', 'kamilpass', 'klient', NULL),
(12, 'Lidia', 'Wrona', 'lidia.wrona@example.com', 'lidia321', 'klient', NULL),
(13, 'Mariusz', 'Kubik', 'mariusz.kubik@example.com', 'mariusz2025', 'klient', NULL),
(14, 'Natalia', 'Kruk', 'natalia.kruk@example.com', 'natalia!', 'klient', NULL),
(15, 'Oskar', 'Wilk', 'oskar.wilk@example.com', 'oskarpass', 'klient', NULL),
(16, 'Jan', 'Kowalski', 'jan.kowalski@example.com', 'szef123', 'szef', 1),
(17, 'Anna', 'Nowak', 'anna.nowak@example.com', 'fryzjerka1', 'fryzjer', 2),
(18, 'Piotr', 'Wiśniewski', 'piotr.wisniewski@example.com', 'fryzjerpiotr', 'fryzjer', 3),
(19, 'Katarzyna', 'Wójcik', 'katarzyna.wojcik@example.com', 'kasia2025', 'fryzjer', 4),
(20, 'Michał', 'Krawczyk', 'michal.krawczyk@example.com', 'michalpass', 'fryzjer', 5),
(21, 'Ewa', 'Zielińska', 'ewa.zielinska@example.com', 'ewaziel', 'fryzjer', 6),
(22, 'Tomasz', 'Sikora', 'tomasz.sikora@example.com', 'tomasz321', 'fryzjer', 7),
(23, 'Agnieszka', 'Lewandowska', 'agnieszka.lewandowska@example.com', 'sprzatanie1', 'sprzataczka', 8),
(24, 'Marcin', 'Duda', 'marcin.duda@example.com', 'sprzatanie2', 'sprzataczka', 9),
(25, 'Magdalena', 'Kaczmarek', 'magdalena.kaczmarek@example.com', 'sprzataczka3', 'sprzataczka', 10),
(26, 'Robert', 'Mazur', 'robert.mazur@example.com', 'sprzatanie4', 'sprzataczka', 11),
(27, 'Joanna', 'Kowalczyk', 'joanna.kowalczyk@example.com', 'sprzataczka5', 'sprzataczka', 12),
(28, 'Łukasz', 'Baran', 'lukasz.baran@example.com', 'sprzatanie6', 'sprzataczka', 13),
(29, 'Monika', 'Szymańska', 'monika.szymanska@example.com', 'sprzatanie7', 'sprzataczka', 14),
(30, 'Paweł', 'Włodarczyk', 'pawel.wlodarczyk@example.com', 'sprzataczka8', 'sprzataczka', 15),
(31, '', '', '', 'aaa', 'klient', NULL),
(32, 'agnieszka', 'nowak', 'test2@gmail.com', 'aaa', 'klient', NULL),
(33, 'zbigniew', 'kruk', 'test3@djd.pl', 'aaa', 'klient', NULL),
(34, 'zbigniew', 'kruk', 'fvf@ff', 'aaa', 'klient', NULL),
(35, 'Paweł', 'Nowak', 'test3@gmail.com', 'bbb', 'klient', NULL),
(36, 'agnieszka', 'kruk', 'fggf@cvv', 'aaa', 'klient', NULL),
(37, 'agnieszka', 'nowak', 'test4@df', 'aa', 'klient', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uslugi`
--

CREATE TABLE `uslugi` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `czas_trwania` time NOT NULL,
  `id_kategorii` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uslugi`
--

INSERT INTO `uslugi` (`id`, `nazwa`, `cena`, `czas_trwania`, `id_kategorii`) VALUES
(1, 'Strzyżenie (z myciem i modelowaniem)', 130.00, '01:00:00', 1),
(2, 'Modelowanie (lokówka/prostownica)', 90.00, '00:45:00', 1),
(3, 'Farbowanie odrostów', 160.00, '01:30:00', 1),
(4, 'Koloryzacja całościowa', 220.00, '02:00:00', 1),
(5, 'Balayage / Ombre', 280.00, '02:30:00', 1),
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
(19, 'Voucher o wartości 200 zł', 200.00, '00:00:00', 6),
(20, 'Voucher o wartości 300 zł (z opakowaniem)', 300.00, '00:00:00', 6);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_usluga` (`id_usluga`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategorii` (`id_kategorii`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rezerwacje_ibfk_2` FOREIGN KEY (`id_usluga`) REFERENCES `uslugi` (`id`),
  ADD CONSTRAINT `rezerwacje_ibfk_3` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id`);

--
-- Constraints for table `uslugi`
--
ALTER TABLE `uslugi`
  ADD CONSTRAINT `uslugi_ibfk_1` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie_uslug` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
