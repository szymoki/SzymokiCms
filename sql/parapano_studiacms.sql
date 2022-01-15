-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 15 Sty 2022, 17:53
-- Wersja serwera: 10.4.22-MariaDB-cll-lve
-- Wersja PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `parapano_studiacms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `acl`
--

CREATE TABLE `acl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acl_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `acl`
--

INSERT INTO `acl` (`id`, `user_id`, `acl_name`) VALUES
(1, 2, 'pages'),
(2, 2, 'news'),
(3, 2, 'p0_1'),
(4, 2, 'p0_2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czw_data`
--

CREATE TABLE `czw_data` (
  `id` mediumint(9) NOT NULL,
  `title` varchar(80) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `text` text COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `folder` varchar(64) NOT NULL,
  `title` varchar(128) NOT NULL,
  `text` text NOT NULL,
  `published` int(11) DEFAULT NULL,
  `edited_date` datetime NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `pozycja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `gallery`
--

INSERT INTO `gallery` (`id`, `folder`, `title`, `text`, `published`, `edited_date`, `added_date`, `added_by`, `pozycja`) VALUES
(1, 'zdjecia', 'Przykładowy album', 'Opis albumu', 1, '2022-01-08 15:21:53', '2022-01-08 15:15:33', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log` text NOT NULL,
  `date` datetime NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `log`, `date`, `type`) VALUES
(1, 1, 'Zalogowano się', '2022-01-08 12:01:59', 0),
(2, 1, 'Zalogowano się', '2022-01-08 14:43:21', 0),
(3, 1, 'Dodanie elementu slidera 1', '2022-01-08 14:43:57', 0),
(4, 1, 'Edycja elementu slidera 1', '2022-01-08 14:44:34', 0),
(5, 1, 'Dodanie elementu slidera 2', '2022-01-08 14:45:01', 0),
(6, 1, 'Edycja elementu slidera 2', '2022-01-08 14:45:21', 0),
(7, 1, 'Edycja sześciokąta Przejrzysty', '2022-01-08 14:46:45', 0),
(8, 1, 'Edycja sześciokąta Szybki', '2022-01-08 14:46:55', 0),
(9, 1, 'Edycja sześciokąta Lekki', '2022-01-08 14:47:05', 0),
(10, 1, 'Edycja sześciokąta Łatwy w obsłudze', '2022-01-08 14:47:28', 0),
(11, 1, 'Dodanie newsa: Czy systemy CMS to przyszłość?', '2022-01-08 14:48:50', 0),
(12, 1, 'Edycja newsa: Czy systemy CMS to przyszłość?', '2022-01-08 14:49:12', 0),
(13, 1, 'Dodanie pozycji głownego menu: 1/Home', '2022-01-08 14:49:37', 0),
(14, 1, 'Dodanie pozycji głownego menu: 2/Przykładowa podstrona', '2022-01-08 14:49:50', 0),
(15, 1, 'Dodanie pozycji głownego menu: 3/O nas', '2022-01-08 14:50:03', 0),
(16, 1, 'Edycja pozycji głownego menu: 3/O nas', '2022-01-08 14:50:10', 0),
(17, 1, 'Edycja pozycji głownego menu: 2/Przykładowa podstrona', '2022-01-08 14:50:16', 0),
(18, 1, 'Dodanie podstrony: 1/O nas', '2022-01-08 14:52:29', 0),
(19, 1, 'Dodanie podstrony: 2/Przykładowa strona', '2022-01-08 14:52:45', 0),
(20, 1, 'Edycja pozycji głownego menu: 1/Home', '2022-01-08 14:53:07', 0),
(21, 1, 'Dodanie albumu: 1/Przykładowy album', '2022-01-08 15:15:33', 0),
(22, 1, 'Edycja albumu: 1/Przykładowy album', '2022-01-08 15:21:53', 0),
(23, 1, 'Edycja danych szablonu', '2022-01-08 15:22:35', 0),
(24, 1, 'Dodanie newsa: Czy szybka robota jest warta zachodu?', '2022-01-08 15:23:18', 0),
(25, 1, 'Dodanie strony przedmiotowej: 1/Sieci internetowe', '2022-01-08 15:25:15', 0),
(26, 1, 'Dodanie podstrony: 3/Historia', '2022-01-08 15:25:47', 0),
(27, 1, 'Dodanie podstrony: 4/Ważne pojęcia', '2022-01-08 15:25:59', 0),
(28, 1, 'Dodanie pozycji głownego menu: 4/Historia', '2022-01-08 16:53:59', 0),
(29, 1, 'Edycja podstrony: 3/Historia', '2022-01-08 16:54:18', 0),
(30, 1, 'Zalogowano się', '2022-01-15 16:04:02', 0),
(31, 1, 'Zmiana hasła', '2022-01-15 16:06:18', 0),
(32, 1, 'Edycja użytkownika: admin', '2022-01-15 16:07:29', 0),
(33, 1, 'Zalogowano się', '2022-01-15 16:08:15', 0),
(34, 1, 'Zalogowano się', '2022-01-15 16:08:21', 0),
(35, 1, 'Dodanie newsa: TEST', '2022-01-15 16:28:13', 0),
(36, 1, 'Usunięcie newsa: TEST', '2022-01-15 16:28:16', 0),
(37, 1, 'Edycja podstrony: 2/Przykładowa strona', '2022-01-15 16:28:24', 0),
(38, 1, 'Dodanie użytkownika: moderator', '2022-01-15 16:29:18', 0),
(39, 2, 'Zalogowano się', '2022-01-15 16:29:27', 0),
(40, 1, 'Zalogowano się', '2022-01-15 16:29:35', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `url` varchar(64) NOT NULL,
  `active` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `pozycja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `active`, `parent_id`, `pozycja`) VALUES
(1, 'Home', '/', 1, 0, 1),
(2, 'Przykładowa podstrona', '/strona', 1, 0, 2),
(3, 'O nas', '/onas', 1, 0, 3),
(4, 'Historia', '/historia', 1, 3, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `text` text CHARACTER SET ucs2 NOT NULL,
  `category` int(11) NOT NULL,
  `super` int(11) DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `edited_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `mainphoto` varchar(64) CHARACTER SET ucs2 DEFAULT NULL,
  `mainpage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `category`, `super`, `published`, `create_date`, `create_by`, `edited_date`, `edited_by`, `mainphoto`, `mainpage`) VALUES
(1, 'Czy systemy CMS to przyszłość?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n\r\n<hr />\r\n<p>Donec hendrerit venenatis nisi. Sed aliquam ultrices est sit amet elementum. Integer aliquet ut tortor id cursus. Nulla id semper sem. Morbi in sapien sit amet diam malesuada auctor. Nunc egestas dui eget erat finibus, sit amet scelerisque augue posuere. Praesent elit ipsum, ultricies at blandit in, euismod id felis. Nullam ornare efficitur nisi in elementum. Donec lectus purus, pretium scelerisque lorem non, lacinia porta ante. Integer neque urna, volutpat quis justo ac, suscipit varius nulla. Sed vitae sapien sit amet orci commodo fermentum at eget augue. Cras sodales iaculis lectus, quis luctus sem. Nulla facilisi. Nunc ac volutpat purus.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Morbi pharetra metus quis augue tincidunt luctus vitae porttitor dolor. Nulla gravida finibus nulla nec eleifend. Curabitur posuere felis et nunc consectetur vestibulum. Morbi accumsan elit quis lacus ultrices tristique. Aliquam iaculis dolor vel elementum bibendum. Ut nec leo ex. Nam vel venenatis ipsum. Phasellus ac vulputate nunc. Donec diam ex, egestas ut viverra in, lobortis quis lorem. Cras velit metus, tempor in molestie et, blandit facilisis libero. Maecenas placerat varius eros, a mattis justo suscipit eget. Donec dolor quam, vulputate id magna id, rutrum facilisis magna. Maecenas nec urna ipsum. Proin quis metus ultricies, iaculis lacus id, feugiat metus.</p>\r\n', 0, NULL, 1, '2022-01-08 14:48:50', 1, '2022-01-08 14:49:12', 1, NULL, 1),
(2, 'Czy szybka robota jest warta zachodu?', '<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n\r\n<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n\r\n<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', 0, NULL, 1, '2022-01-08 15:23:18', 1, '2022-01-08 15:23:18', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `category` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `edited_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `symlink` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `title`, `text`, `category`, `published`, `create_date`, `create_by`, `edited_date`, `edited_by`, `parent_id`, `symlink`) VALUES
(1, 'O nas', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n\r\n<p>Donec hendrerit venenatis nisi. Sed aliquam ultrices est sit amet elementum. Integer aliquet ut tortor id cursus. Nulla id semper sem. Morbi in sapien sit amet diam malesuada auctor. Nunc egestas dui eget erat finibus, sit amet scelerisque augue posuere. Praesent elit ipsum, ultricies at blandit in, euismod id felis. Nullam ornare efficitur nisi in elementum. Donec lectus purus, pretium scelerisque lorem non, lacinia porta ante. Integer neque urna, volutpat quis justo ac, suscipit varius nulla. Sed vitae sapien sit amet orci commodo fermentum at eget augue. Cras sodales iaculis lectus, quis luctus sem. Nulla facilisi. Nunc ac volutpat purus.</p>\r\n\r\n<p>Morbi pharetra metus quis augue tincidunt luctus vitae porttitor dolor. Nulla gravida finibus nulla nec eleifend. Curabitur posuere felis et nunc consectetur vestibulum. Morbi accumsan elit quis lacus ultrices tristique. Aliquam iaculis dolor vel elementum bibendum. Ut nec leo ex. Nam vel venenatis ipsum. Phasellus ac vulputate nunc. Donec diam ex, egestas ut viverra in, lobortis quis lorem. Cras velit metus, tempor in molestie et, blandit facilisis libero. Maecenas placerat varius eros, a mattis justo suscipit eget. Donec dolor quam, vulputate id magna id, rutrum facilisis magna. Maecenas nec urna ipsum. Proin quis metus ultricies, iaculis lacus id, feugiat metus.</p>\r\n', 0, 1, '2022-01-08 14:52:29', 1, '2022-01-08 14:52:29', 1, 0, 'onas'),
(2, 'Przykładowa strona', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habistant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n\r\n<p>Donec hendrerit venenatis nisi. Sed aliquam ultrices est sit amet elementum. Integer aliquet ut tortor id cursus. Nulla id semper sem. Morbi in sapien sit amet diam malesuada auctor. Nunc egestas dui eget erat finibus, sit amet scelerisque augue posuere. Praesent elit ipsum, ultricies at blandit in, euismod id felis. Nullam ornare efficitur nisi in elementum. Donec lectus purus, pretium scelerisque lorem non, lacinia porta ante. Integer neque urna, volutpat quis justo ac, suscipit varius nulla. Sed vitae sapien sit amet orci commodo fermentum at eget augue. Cras sodales iaculis lectus, quis luctus sem. Nulla facilisi. Nunc ac volutpat purus.</p>\r\n\r\n<p>Morbi pharetra metus quis augue tincidunt luctus vitae porttitor dolor. Nulla gravida finibus nulla nec eleifend. Curabitur posuere felis et nunc consectetur vestibulum. Morbi accumsan elit quis lacus ultrices tristique. Aliquam iaculis dolor vel elementum bibendum. Ut nec leo ex. Nam vel venenatis ipsum. Phasellus ac vulputate nunc. Donec diam ex, egestas ut viverra in, lobortis quis lorem. Cras velit metus, tempor in molestie et, blandit facilisis libero. Maecenas placerat varius eros, a mattis justo suscipit eget. Donec dolor quam, vulputate id magna id, rutrum facilisis magna. Maecenas nec urna ipsum. Proin quis metus ultricies, iaculis lacus id, feugiat metus.</p>\r\n', 0, 1, '2022-01-08 14:52:45', 1, '2022-01-15 16:28:24', 1, 0, 'strona'),
(3, 'Historia', '<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n</div>\r\n</div>\r\n', 0, 1, '2022-01-08 15:25:47', 1, '2022-01-08 16:54:18', 1, 1, 'historia'),
(4, 'Ważne pojęcia', '<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n</div>\r\n</div>\r\n', 0, 1, '2022-01-08 15:25:59', 1, '2022-01-08 15:25:59', 1, 1, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages_addlinks`
--

CREATE TABLE `pages_addlinks` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `page_type` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `url` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `pages_addlinks`
--

INSERT INTO `pages_addlinks` (`id`, `page_id`, `title`, `parent_id`, `page_type`, `position`, `url`) VALUES
(1, 3, 'Historia', 1, 0, 0, ''),
(2, 4, 'Ważne pojęcia', 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages_przedmioty`
--

CREATE TABLE `pages_przedmioty` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `category` int(11) NOT NULL,
  `published` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `edited_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `symlink` varchar(64) NOT NULL,
  `img` varchar(128) DEFAULT NULL,
  `newsletter` int(11) DEFAULT NULL,
  `menushow` int(11) DEFAULT NULL,
  `pozycja` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `pages_przedmioty`
--

INSERT INTO `pages_przedmioty` (`id`, `title`, `text`, `category`, `published`, `create_date`, `create_by`, `edited_date`, `edited_by`, `parent_id`, `symlink`, `img`, `newsletter`, `menushow`, `pozycja`) VALUES
(1, 'Sieci internetowe', '<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n</div>\r\n</div>\r\n', 0, 1, '2022-01-08 15:25:15', 1, '2022-01-08 15:25:15', 1, 0, 'sieci', '/upload_media/gallery/zdjecia/img_4.jpg', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `site_log`
--

CREATE TABLE `site_log` (
  `site_log_id` int(10) UNSIGNED NOT NULL,
  `no_of_visits` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `requested_url` tinytext NOT NULL,
  `referer_page` tinytext NOT NULL,
  `page_name` tinytext NOT NULL,
  `query_string` tinytext NOT NULL,
  `user_agent` tinytext NOT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT 0,
  `access_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `text` varchar(64) NOT NULL,
  `btn_text` varchar(32) NOT NULL,
  `url` varchar(64) NOT NULL,
  `image_path` varchar(64) NOT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `slider`
--

INSERT INTO `slider` (`id`, `text`, `btn_text`, `url`, `image_path`, `active`) VALUES
(1, 'Prosty CMS', 'Zobacz więcej', '/onas', '/themes/eskwela/images/blog-1.jpg', 1),
(2, 'Nowoczecny', 'O nas', '/onas', '/themes/eskwela/images/blog-2.jpg', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(32) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `last_login` datetime NOT NULL,
  `level` int(11) NOT NULL,
  `last_ip` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `nick`, `name`, `password`, `email`, `last_login`, `level`, `last_ip`) VALUES
(1, 'admin', 'admin', '$2y$10$DNG4J.uKtNtWAW48ahpf3OLlVetoPfIG/TxkWRVJt.EQe93G7U9M2', 'szymon.haczyk@icloud.com', '2022-01-15 16:29:35', 0, '178.214.13.88'),
(2, 'moderator', 'Jan Kowalski', '$2y$10$MNxqJAFI8T0mzIA4GDbh4OAceeJDYt6NChJ.udriYJX8NTsvSbOae', 'moderator@cms.pl', '2022-01-15 16:29:27', 1, '178.214.13.88');

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
-- Zrzut danych tabeli `zmienne`
--

INSERT INTO `zmienne` (`id`, `name`, `value`) VALUES
(1, 'licznik1', '50'),
(2, 'licznik2', '926'),
(3, 'licznik3', '63'),
(4, 'licznik4', '234'),
(5, 'text_startup', '<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur purus gravida. Cras eget sapien et erat suscipit suscipit eget et mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer hendrerit vel eros sed tincidunt. Aliquam ut urna sed ante mattis gravida non quis velit. Vestibulum tincidunt commodo consectetur. Nam mattis lorem nec nisi convallis, dapibus efficitur mauris fringilla. Nullam eleifend sit amet tellus a mollis. Mauris eu quam sed felis iaculis gravida. Duis fringilla eros vitae risus molestie, nec pulvinar sapien porttitor. Vestibulum dignissim venenatis nisl euismod tincidunt. Vivamus laoreet nec ligula nec tempus.</p>\r\n</div>\r\n</div>\r\n'),
(6, 'licznik_on', '1'),
(7, 'uczniowie_on', '0'),
(8, 'newsletter_on', '1'),
(9, 'boxy_on', '1'),
(11, 'pieciokat1', '{\"title\":\"Przejrzysty\",\"url\":\"\\/onas\",\"icon\":\"professor\",\"text\":\" Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. \"}'),
(12, 'pieciokat2', '{\"title\":\"Szybki\",\"url\":\"page_p\\/25\",\"icon\":\"book\",\"text\":\" Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. \"}'),
(13, 'pieciokat3', '{\"title\":\"Lekki\",\"url\":\"biblioteka\",\"icon\":\"books\",\"text\":\" Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. \"}'),
(14, 'pieciokat4', '{\"title\":\"\\u0141atwy w obs\\u0142udze\",\"url\":\"szok\",\"icon\":\"diploma\",\"text\":\" Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. \"}'),
(15, 'text_sponsorzy', '<div id=\"bannerL\">\r\n<div id=\"div-gpt-ad-1474537762122-2\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"bannerR\">\r\n<div id=\"div-gpt-ad-1474537762122-3\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin interdum ex at aliquam. Aliquam tincidunt sapien vel tortor bibendum auctor. Etiam pretium elit in convallis mattis. Nullam sollicitudin in tortor sit amet volutpat. Donec facilisis nunc sed mi aliquam, vitae consectetur puru</p>\r\n</div>\r\n</div>\r\n');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `czw_data`
--
ALTER TABLE `czw_data`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `czw_data` ADD FULLTEXT KEY `text` (`text`);

--
-- Indeksy dla tabeli `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pages_addlinks`
--
ALTER TABLE `pages_addlinks`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pages_przedmioty`
--
ALTER TABLE `pages_przedmioty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `site_log`
--
ALTER TABLE `site_log`
  ADD PRIMARY KEY (`site_log_id`);

--
-- Indeksy dla tabeli `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zmienne`
--
ALTER TABLE `zmienne`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `acl`
--
ALTER TABLE `acl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `czw_data`
--
ALTER TABLE `czw_data`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `pages_addlinks`
--
ALTER TABLE `pages_addlinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pages_przedmioty`
--
ALTER TABLE `pages_przedmioty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `site_log`
--
ALTER TABLE `site_log`
  MODIFY `site_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `zmienne`
--
ALTER TABLE `zmienne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
