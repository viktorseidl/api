-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Okt 2022 um 14:46
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dsschema`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `ID` int(11) NOT NULL,
  `Name1` varchar(50) NOT NULL,
  `Name2` varchar(50) NOT NULL,
  `Pin` varchar(50) NOT NULL,
  `TimeTouchNr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`ID`, `Name1`, `Name2`, `Pin`, `TimeTouchNr`) VALUES
(1, 'Musterma', 'Max', 'passwort', 2),
(2, 'Mustermann', 'Tanja', '123456', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiterurlaubsbezeichnungen`
--

CREATE TABLE `mitarbeiterurlaubsbezeichnungen` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(50) NOT NULL,
  `Kuerzel` varchar(6) NOT NULL,
  `DBK` varchar(3) NOT NULL,
  `Farbe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mitarbeiterurlaubsbezeichnungen`
--

INSERT INTO `mitarbeiterurlaubsbezeichnungen` (`ID`, `Bezeichnung`, `Kuerzel`, `DBK`, `Farbe`) VALUES
(1, 'Urlaub', 'U', '1', ''),
(2, 'Krank', 'K', '2', ''),
(3, 'Fortbildung', 'FB', '3', ''),
(4, 'Sonderurlaub', 'SU', '4', ''),
(5, 'Schule', 'SCH', '5', ''),
(6, 'Ersatzfrei', 'EF', '6', ''),
(7, 'Feiertagsarbeit', 'FA', '7', ''),
(8, 'Kind Krank', 'KK', '8', ''),
(9, 'Kur', 'KU', '9', ''),
(10, 'Mutterschutz', 'MS', 'A', ''),
(11, 'Überstundenfrei', 'ÜF', 'C', ''),
(12, 'Krank ohne Lohn', 'Kol', 'z', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `murlaub`
--

CREATE TABLE `murlaub` (
  `ID` int(11) NOT NULL,
  `MID` int(11) NOT NULL,
  `Monat` int(11) NOT NULL,
  `Jahr` int(11) NOT NULL,
  `Belegung` varchar(31) NOT NULL,
  `Urlaubstage` int(11) NOT NULL,
  `RestUrlaub` int(11) NOT NULL,
  `Sonderurlaub` int(11) NOT NULL,
  `SonderurlaubText` varchar(255) NOT NULL,
  `Ausbezahlt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `murlaub`
--

INSERT INTO `murlaub` (`ID`, `MID`, `Monat`, `Jahr`, `Belegung`, `Urlaubstage`, `RestUrlaub`, `Sonderurlaub`, `SonderurlaubText`, `Ausbezahlt`) VALUES
(1, 2, 10, 2022, '0020010002000100000100000000000', 30, 0, 0, '', 0),
(2, 1, 10, 2022, '0001000010020000012224000000000', 27, 0, 0, '', 0),
(3, 1, 1, 2022, '0020010002010104401111000000000', 30, 0, 0, '', 0),
(4, 1, 11, 2022, '0020010002010104441111000111000', 30, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetouchbuchungen`
--

CREATE TABLE `timetouchbuchungen` (
  `ID` int(11) NOT NULL,
  `MID` int(11) NOT NULL,
  `Personalnr` varchar(5) NOT NULL,
  `Monat` int(11) NOT NULL,
  `Jahr` int(11) NOT NULL,
  `Datum` varchar(10) NOT NULL,
  `Uhrzeit` varchar(10) NOT NULL,
  `Buchung` varchar(30) NOT NULL,
  `ImportDatum` varchar(25) NOT NULL,
  `User` varchar(5) NOT NULL,
  `Vorgang` int(11) NOT NULL,
  `extDate` varchar(25) NOT NULL,
  `extDateTime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `timetouchbuchungen`
--

INSERT INTO `timetouchbuchungen` (`ID`, `MID`, `Personalnr`, `Monat`, `Jahr`, `Datum`, `Uhrzeit`, `Buchung`, `ImportDatum`, `User`, `Vorgang`, `extDate`, `extDateTime`) VALUES
(1, 1, '0002', 10, 2022, '04.10.22', '22:37', '@t01ZB22100422370020002', '2022-10-04 22:37:00', 'sc', 2, '2022-10-04 00:00:00.000', '2022-10-04 22:37:00.000'),
(2, 1, '0002', 10, 2022, '04.10.22', '22:37', '@t01ZB22100422370020002', '2022-10-04 22:37:00', 'sc', 3, '2022-10-04 00:00:00.000', '2022-10-04 22:37:00.000'),
(12, 1, '0002', 10, 2022, '05.10.22', '00:52', '@t01ZB22100500520020002', '2022-10-05 00:52:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 00:52:00.000'),
(13, 1, '0002', 10, 2022, '05.10.22', '00:58', '@t01ZB22100500580030002', '2022-10-05 00:58:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 00:58:00.000'),
(14, 1, '0002', 10, 2022, '05.10.22', '00:58', '@t01ZB22100500580020002', '2022-10-05 00:58:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 00:58:00.000'),
(15, 1, '0002', 10, 2022, '05.10.22', '00:58', '@t01ZB22100500580030002', '2022-10-05 00:58:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 00:58:00.000'),
(16, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590020002', '2022-10-05 00:59:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(17, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590030002', '2022-10-05 00:59:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(18, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590020002', '2022-10-05 00:59:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(19, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590030002', '2022-10-05 00:59:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(20, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590020002', '2022-10-05 00:59:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(21, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590030002', '2022-10-05 00:59:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(22, 1, '0002', 10, 2022, '05.10.22', '00:59', '@t01ZB22100500590020002', '2022-10-05 00:59:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 00:59:00.000'),
(23, 1, '0002', 10, 2022, '05.10.22', '01:01', '@t01ZB22100501010030002', '2022-10-05 01:01:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:01:00.000'),
(24, 1, '0002', 10, 2022, '05.10.22', '01:02', '@t01ZB22100501020020002', '2022-10-05 01:02:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:02:00.000'),
(25, 1, '0002', 10, 2022, '05.10.22', '01:02', '@t01ZB22100501020030002', '2022-10-05 01:02:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:02:00.000'),
(26, 1, '0002', 10, 2022, '05.10.22', '01:07', '@t01ZB22100501070020002', '2022-10-05 01:07:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:07:00.000'),
(27, 1, '0002', 10, 2022, '05.10.22', '01:07', '@t01ZB22100501070030002', '2022-10-05 01:07:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:07:00.000'),
(28, 1, '0002', 10, 2022, '05.10.22', '01:07', '@t01ZB22100501070020002', '2022-10-05 01:07:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:07:00.000'),
(112, 1, '0002', 10, 2022, '05.10.22', '01:34', '@t01ZB22100501340030002', '2022-10-05 01:34:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:34:00.000'),
(113, 1, '0002', 10, 2022, '05.10.22', '01:34', '@t01ZB22100501340020002', '2022-10-05 01:34:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:34:00.000'),
(114, 1, '0002', 10, 2022, '05.10.22', '01:39', '@t01ZB22100501390030002', '2022-10-05 01:39:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:39:00.000'),
(115, 1, '0002', 10, 2022, '05.10.22', '01:40', '@t01ZB22100501400020002', '2022-10-05 01:40:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:40:00.000'),
(116, 1, '0002', 10, 2022, '05.10.22', '01:45', '@t01ZB22100501450030002', '2022-10-05 01:45:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:45:00.000'),
(117, 1, '0002', 10, 2022, '05.10.22', '01:50', '@t01ZB22100501500020002', '2022-10-05 01:50:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:50:00.000'),
(118, 1, '0002', 10, 2022, '05.10.22', '01:50', '@t01ZB22100501500020002', '2022-10-05 01:50:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 01:50:00.000'),
(119, 1, '0002', 10, 2022, '05.10.22', '01:51', '@t01ZB22100501510030002', '2022-10-05 01:51:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:51:00.000'),
(120, 1, '0002', 10, 2022, '05.10.22', '01:51', '@t01ZB22100501510030002', '2022-10-05 01:51:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 01:51:00.000'),
(121, 1, '0002', 10, 2022, '05.10.22', '09:02', '@t01ZB22100509020020002', '2022-10-05 09:02:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 09:02:00.000'),
(122, 1, '0002', 10, 2022, '05.10.22', '14:48', '@t01ZB22100514480030002', '2022-10-05 14:48:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 14:48:00.000'),
(123, 1, '0002', 10, 2022, '05.10.22', '14:48', '@t01ZB22100514480030002', '2022-10-05 14:48:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 14:48:00.000'),
(124, 1, '0002', 10, 2022, '05.10.22', '14:49', '@t01ZB22100514490030002', '2022-10-05 14:49:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 14:49:00.000'),
(125, 1, '0002', 10, 2022, '05.10.22', '14:49', '@t01ZB22100514490030002', '2022-10-05 14:49:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 14:49:00.000'),
(126, 1, '0002', 10, 2022, '05.10.22', '15:42', '@t01ZB22100515420020002', '2022-10-05 15:42:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 15:42:00.000'),
(127, 1, '0002', 10, 2022, '05.10.22', '15:49', '@t01ZB22100515490030002', '2022-10-05 15:49:00', 'sc', 3, '2022-10-05 00:00:00.000', '2022-10-05 15:49:00.000'),
(128, 1, '0002', 10, 2022, '05.10.22', '16:18', '@t01ZB22100516180020002', '2022-10-05 16:18:00', 'sc', 2, '2022-10-05 00:00:00.000', '2022-10-05 16:18:00.000'),
(129, 1, '', 0, 0, '', '', '', '', '', 0, '', ''),
(130, 1, '', 0, 0, '', '', '', '', '', 0, '', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Name1` (`Name1`),
  ADD KEY `Name2` (`Name2`),
  ADD KEY `Pin` (`Pin`),
  ADD KEY `TimeTouchNr` (`TimeTouchNr`);

--
-- Indizes für die Tabelle `mitarbeiterurlaubsbezeichnungen`
--
ALTER TABLE `mitarbeiterurlaubsbezeichnungen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Kuerzel` (`Kuerzel`),
  ADD KEY `Farbe` (`Farbe`);

--
-- Indizes für die Tabelle `murlaub`
--
ALTER TABLE `murlaub`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MID` (`MID`),
  ADD KEY `Monat` (`Monat`),
  ADD KEY `Jahr` (`Jahr`),
  ADD KEY `Belegung` (`Belegung`),
  ADD KEY `Urlaubstage` (`Urlaubstage`),
  ADD KEY `RestUrlaub` (`RestUrlaub`);

--
-- Indizes für die Tabelle `timetouchbuchungen`
--
ALTER TABLE `timetouchbuchungen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MID` (`MID`),
  ADD KEY `Personalnr` (`Personalnr`),
  ADD KEY `Monat` (`Monat`),
  ADD KEY `Jahr` (`Jahr`),
  ADD KEY `Datum` (`Datum`),
  ADD KEY `Uhrzeit` (`Uhrzeit`),
  ADD KEY `extDate` (`extDate`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mitarbeiterurlaubsbezeichnungen`
--
ALTER TABLE `mitarbeiterurlaubsbezeichnungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `murlaub`
--
ALTER TABLE `murlaub`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `timetouchbuchungen`
--
ALTER TABLE `timetouchbuchungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
