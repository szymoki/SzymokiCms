-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Sty 2022, 12:08
-- Wersja serwera: 10.4.21-MariaDB-cll-lve
-- Wersja PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `parapano_loken`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zmienne`
--

CREATE TABLE `zmienne` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Tabela Truncate przed wstawieniem `zmienne`
--

TRUNCATE TABLE `zmienne`;
--
-- Zrzut danych tabeli `zmienne`
--

INSERT INTO `zmienne` (`id`, `name`, `value`) VALUES
(1, 'licznik1', '50'),
(2, 'licznik2', '926'),
(3, 'licznik3', '63'),
(4, 'licznik4', '234'),
(5, 'text_startup', '<h5 style=\"text-align:center\"><strong>Witamy na <span style=\"color:#e74c3c\">nieoficjalnej</span> stronie I Liceum Og&oacute;lnokształcącego im. Komisji Edukacji Narodowej<br />\r\nw Stalowej Woli</strong></h5>\r\n\r\n<p style=\"text-align:center\">Zapraszamy wszystkich do zapoznania się z naszym serwisem internetowym. Jesteśmy, przekonani, że wszyscy zainteresowani znajdą tu szereg ważnych informacji z życia szkoły!<br />\r\n&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">Nasza archiwalna strona znajduje sie pod adresem: <a href=\"http://www.old.loken.pl\" target=\"_blank\">old.loken.pl</a><em>&nbsp; </em><small>&copy; LOKEN(2006-2020)</small><br />\r\n&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"http://licea.perspektywy.pl/2020/tabele/ranking-glowny-liceow\" target=\"_blank\"><img alt=\"Stara strona www\" src=\"/upload_media/images/srebrne-liceum-2020.jpg\" style=\"height:85px; width:85px\" /></a>&nbsp;&nbsp;&nbsp; <a href=\"http://licea.perspektywy.pl/2020/tabele/ranking-szkol-olimpijskich\" target=\"_blank\"><img src=\"/upload_media/files/image-20200405200517-1.png\" style=\"height:95px; width:95px\" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.old.loken.pl/\" target=\"_blank\"><img alt=\"\" src=\"/upload_media/files/tarcza2020.png\" style=\"height:88px; width:71px\" /></a></p>\r\n'),
(6, 'licznik_on', '1'),
(7, 'uczniowie_on', '0'),
(8, 'newsletter_on', '1'),
(9, 'boxy_on', '1'),
(11, 'pieciokat1', '{\"title\":\"Gabinet psychologiczny\",\"url\":\"gabinet-psychologiczny\",\"icon\":\"professor\",\"text\":\"<p><strong>Godziny pracy psychologa<\\/strong><\\/p><p>Poniedzia\\u0142ek - 7.00 - 13.00<br>Wtorek - 8.00 - 15.30<br>\\u015aroda - 7.00 - 14.00<br>Czwartek - 8.00 - 14.00<br>Pi\\u0105tek - 7.30 - 14.00<\\/p>\"}'),
(12, 'pieciokat2', '{\"title\":\"Gabinet profilaktyki zdrowotnej\",\"url\":\"page_p\\/25\",\"icon\":\"book\",\"text\":\"<p><strong>Godziny pracy gabinetu<\\/strong><\\/p><p>Poniedzia\\u0142ek - 7.00 - 14.35<br>Wtorek - 7.00 - 14.35<br>Czwartek - 7.00 - 14.35<br>Pi\\u0105tek - 7.00 - 14.35<\\/p>\"}'),
(13, 'pieciokat3', '{\"title\":\"Biblioteka szkolna\",\"url\":\"biblioteka\",\"icon\":\"books\",\"text\":\"<p><strong>Godziny pracy biblioteki szkolnej<\\/strong><\\/p><p>Poniedzia\\u0142ek - 7.00 - 15.00<br>Wtorek - 7.00 - 15.00<br>\\u015aroda - 7.00 - 15.00<br>Czwartek - 7.00 - 15.00<br>Pi\\u0105tek - 7.00 - 14.30<\\/p>\"}'),
(14, 'pieciokat4', '{\"title\":\"Szkolny O\\u015brodek Kariery\",\"url\":\"szok\",\"icon\":\"diploma\",\"text\":\"<p><strong>Godziny pracy SzOK<\\/strong><\\/p><p>Poniedzia\\u0142ek - 8.00 - 13.00<br>Wtorek - 8.00 - 13.00<br>\\u015aroda - 11.00 - 16.00<br>Czwartek - 8.00 - 13.00<br>Pi\\u0105tek - 8.00 - 13.00<\\/p>\"}'),
(15, 'text_sponsorzy', '<p><img alt=\"\" src=\"/upload_media/images/mtu.jpg\" style=\"height:97px; width:157px\" /></p>\r\n');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `zmienne`
--
ALTER TABLE `zmienne`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `zmienne`
--
ALTER TABLE `zmienne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
