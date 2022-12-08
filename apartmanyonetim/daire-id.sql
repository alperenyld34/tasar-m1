-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Ara 2022, 10:37:56
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
-- Veritabanı: `daire-id`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) DEFAULT NULL,
  `site_aciklama` varchar(300) DEFAULT NULL,
  `site_sahibi` varchar(100) DEFAULT NULL,
  `mail_onayi` int(11) DEFAULT NULL,
  `duyuru_onayi` int(11) DEFAULT NULL,
  `site_logo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `site_sahibi`, `mail_onayi`, `duyuru_onayi`, `site_logo`) VALUES
(1, 'Apartman Yönetim', 'Apartman Yönetim', 'Alperen', 0, 0, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `daire`
--

CREATE TABLE `daire` (
  `daire_id` int(5) NOT NULL,
  `daire_no` varchar(250) DEFAULT NULL,
  `daire_sakini` varchar(250) DEFAULT NULL,
  `daire_kira` varchar(10) DEFAULT NULL,
  `kira_tarihi` date DEFAULT NULL,
  `kira_durum` int(1) NOT NULL DEFAULT 0,
  `daire_detay` text DEFAULT NULL,
  `daire_teslim_tarihi` varchar(100) DEFAULT NULL,
  `daire_baslama_tarihi` date DEFAULT NULL,
  `daire_durum` enum('0','1') NOT NULL DEFAULT '0',
  `daire_aciliyet` int(1) NOT NULL DEFAULT 0,
  `dosya_yolu` varchar(500) DEFAULT NULL,
  `yuzde` int(11) NOT NULL DEFAULT 0,
  `eklenme_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `daire`
--

INSERT INTO `daire` (`daire_id`, `daire_no`, `daire_sakini`, `daire_kira`, `kira_tarihi`, `kira_durum`, `daire_detay`, `daire_teslim_tarihi`, `daire_baslama_tarihi`, `daire_durum`, `daire_aciliyet`, `dosya_yolu`, `yuzde`, `eklenme_tarihi`) VALUES
(27, 'A-1', 'Eren Can', '2000', NULL, 0, 'dsf', '1111-11-11', '1111-11-11', '', 0, '361AutophagyRegulationTürkçemangaoku.jpg', 0, '2022-11-01 14:19:55'),
(39, 'A-2', 'Ömer Arif', '1500', '2022-11-03', 1, '<p>qafsdsdfdsf</p>', NULL, NULL, '0', 0, '881smmpanel-1280x720.png', 0, '2022-11-02 00:24:29'),
(40, 'B-1', 'Mustafa Kara', '3000', NULL, 0, '', NULL, NULL, '0', 0, NULL, 0, '2022-11-10 16:16:12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(5) NOT NULL,
  `kul_isim` varchar(200) DEFAULT NULL,
  `kul_mail` varchar(250) DEFAULT NULL,
  `kul_sifre` varchar(250) DEFAULT NULL,
  `kul_telefon` varchar(50) DEFAULT NULL,
  `kul_unvan` varchar(250) DEFAULT NULL,
  `kul_yetki` int(11) DEFAULT NULL,
  `kul_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) DEFAULT NULL,
  `session_mail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_telefon`, `kul_unvan`, `kul_yetki`, `kul_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Alperen Yıldırım', 'alperen@gmail.com', '202cb962ac59075b964b07152d234b70', '0', 'Yazılımcı | Admin', 1, 'logo.png', '::1', '3c00e3fc39308fe1c5a90e28a3e15c72');

-- --------------------------------------------------------
--



--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `daire`
--
ALTER TABLE `daire`
  ADD PRIMARY KEY (`daire_id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`),
  ADD UNIQUE KEY `kul_mail` (`kul_mail`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`sip_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `daire`
--
ALTER TABLE `daire`
  MODIFY `daire_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
