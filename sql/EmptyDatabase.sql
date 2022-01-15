-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Sty 2022, 11:49
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
-- Struktura tabeli dla tabeli `acl`
--

CREATE TABLE `acl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acl_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

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
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `czw_data`
--
ALTER TABLE `czw_data`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pages_addlinks`
--
ALTER TABLE `pages_addlinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pages_przedmioty`
--
ALTER TABLE `pages_przedmioty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `site_log`
--
ALTER TABLE `site_log`
  MODIFY `site_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zmienne`
--
ALTER TABLE `zmienne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
