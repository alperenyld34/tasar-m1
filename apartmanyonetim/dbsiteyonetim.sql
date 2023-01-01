-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Oca 2023, 00:44:40
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dbsiteyonetim`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbldaire`
--

CREATE TABLE `tbldaire` (
  `id` int(11) NOT NULL,
  `blokad` varchar(3) COLLATE utf8_turkish_ci NOT NULL,
  `daireno` int(11) NOT NULL,
  `dolumu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbldaire`
--

INSERT INTO `tbldaire` (`id`, `blokad`, `daireno`, `dolumu`) VALUES
(1, 'A', 0, 0),
(2, 'A', 1, 1),
(3, 'A', 2, 0),
(4, 'A', 3, 0),
(5, 'A', 4, 0),
(6, 'A', 5, 1),
(7, 'A', 6, 0),
(8, 'A', 7, 0),
(9, 'A', 8, 0),
(10, 'A', 9, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tblduyuru`
--

CREATE TABLE `tblduyuru` (
  `id` int(11) NOT NULL,
  `baslik` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `icerik` varchar(5000) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tip` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `tblduyuru`
--

INSERT INTO `tblduyuru` (`id`, `baslik`, `icerik`, `tip`) VALUES
(105, 'Deprem tatbikati olacaktir', 'Deprem tatbikati olacaktir', 'success'),
(104, 'Aidatlar', 'Aidatlarımızı lütfen zamanında yatıralım!', 'info'),
(106, 'Çöpleri Zamanında Atalım', 'Lütfen her gün saat 20:00\'da çöplerinizi kapınızın önüne koyunuz!', 'danger');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tblkullanici`
--

CREATE TABLE `tblkullanici` (
  `id` int(255) NOT NULL,
  `adsoyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tckimlikno` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `evsahibi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `daireid` int(11) DEFAULT NULL,
  `yetki` enum('0','1') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tblkullanici`
--

INSERT INTO `tblkullanici` (`id`, `adsoyad`, `tckimlikno`, `mail`, `adres`, `tel`, `evsahibi`, `sifre`, `daireid`, `yetki`) VALUES
(0, 'Yönetici', '1', '', '', 'undefined', '', '1', NULL, '1'),
(77, 'mehmet', '12345678910', 'komiklinet@gmail.com', 'bilecik merkez', '5555555555', 'Ev Sahibi', '123456', 6, '1'),
(79, 'ahmet kural', '98765432101', 'alperenyld@gmail.com', 'İstanbul yenisahra', '5555555554', 'Kiracı', '123456', 2, '0');

--
-- Tetikleyiciler `tblkullanici`
--
DELIMITER $$
CREATE TRIGGER `kullanicitopasif` AFTER DELETE ON `tblkullanici` FOR EACH ROW INSERT INTO `tblpasif`(`daireid`, `kullaniciid`, `adsoyad`,`tckimlikno`, `tel`,`evsahibi`,`adres`,`kalanborc`) VALUES (OLD.daireid, OLD.id, OLD.adsoyad,OLD.tckimlikno,OLD.tel,OLD.evsahibi,OLD.adres,NULL)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tblpasif`
--

CREATE TABLE `tblpasif` (
  `id` int(11) NOT NULL,
  `daireid` int(11) NOT NULL,
  `kullaniciid` int(11) NOT NULL,
  `adsoyad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `tckimlikno` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `kalanborc` decimal(10,2) DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `evsahibi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(200) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tblpasif`
--

INSERT INTO `tblpasif` (`id`, `daireid`, `kullaniciid`, `adsoyad`, `tckimlikno`, `kalanborc`, `tel`, `evsahibi`, `adres`) VALUES
(1, 7, 78, 'murat ünver', '21212121211', '0.00', '5325325323', 'Kiracı', 'ümraniye'),
(2, 3, 80, 'hakan dere', '12345678933', '500.00', '5555555556', 'Ev Sahibi', 'Bursa Merkez'),
(3, 4, 81, 'kemal öz', '12345678915', '500.00', '5555555553', 'Kiracı', 'Beylikdüzü Istanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tblucret`
--

CREATE TABLE `tblucret` (
  `id` int(11) NOT NULL,
  `ucret` decimal(10,2) NOT NULL,
  `kismi` decimal(10,2) DEFAULT NULL,
  `daireid` int(11) NOT NULL,
  `aciklama` varchar(5000) COLLATE utf8_turkish_ci NOT NULL,
  `nereye` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `odendimi` int(11) NOT NULL,
  `sonodemetarihi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tblucret`
--

INSERT INTO `tblucret` (`id`, `ucret`, `kismi`, `daireid`, `aciklama`, `nereye`, `odendimi`, `sonodemetarihi`) VALUES
(21, '500.00', '100.00', 1, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(22, '500.00', NULL, 2, 'Kira', 'Tüm Dairelere', 1, '2022-12-22'),
(23, '500.00', NULL, 3, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(24, '500.00', NULL, 4, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(25, '500.00', NULL, 5, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(26, '500.00', NULL, 6, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(27, '500.00', NULL, 7, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(28, '500.00', NULL, 8, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(29, '500.00', NULL, 9, 'Kira', 'Tüm Dairelere', 0, '2022-12-22'),
(30, '500.00', NULL, 10, 'Kira', 'Tüm Dairelere', 0, '2022-12-22');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tbldaire`
--
ALTER TABLE `tbldaire`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tblduyuru`
--
ALTER TABLE `tblduyuru`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tblkullanici`
--
ALTER TABLE `tblkullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tblpasif`
--
ALTER TABLE `tblpasif`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tblucret`
--
ALTER TABLE `tblucret`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tbldaire`
--
ALTER TABLE `tbldaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `tblduyuru`
--
ALTER TABLE `tblduyuru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Tablo için AUTO_INCREMENT değeri `tblkullanici`
--
ALTER TABLE `tblkullanici`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Tablo için AUTO_INCREMENT değeri `tblpasif`
--
ALTER TABLE `tblpasif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `tblucret`
--
ALTER TABLE `tblucret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
