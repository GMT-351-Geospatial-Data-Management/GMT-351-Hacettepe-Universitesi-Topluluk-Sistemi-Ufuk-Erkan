-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Oca 2023, 00:24:24
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hacettepetopluluk`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `clubs`
--

CREATE TABLE `clubs` (
  `clubs_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `clubs`
--

INSERT INTO `clubs` (`clubs_id`, `name`) VALUES
(1, 'IEEE'),
(2, 'GMT'),
(3, 'KOBİT'),
(4, 'SATRANÇ'),
(9, 'UFUKERKANTOPLULUĞU');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `events`
--

CREATE TABLE `events` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `event_details` varchar(255) NOT NULL,
  `event_organizer` int(11) NOT NULL,
  `event_date` timestamp NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `events`
--

INSERT INTO `events` (`event_id`, `event_details`, `event_organizer`, `event_date`) VALUES
(1, 'Tanışma Toplantısı 2', 2, '2023-01-20 12:00:00'),
(6, 'KONUMSALDAN A(MİN B OLSUN HOCAM) İLE GEÇİŞ', 9, '2023-01-20 09:12:00'),
(7, 'MAGNUS İLE TANIŞMA', 4, '2023-01-08 23:26:00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`clubs_id`);

--
-- Tablo için indeksler `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `clubs`
--
ALTER TABLE `clubs`
  MODIFY `clubs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `events`
--
ALTER TABLE `events`
  MODIFY `event_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
