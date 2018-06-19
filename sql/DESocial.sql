-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamaný: 18 Haz 2018, 19:03:00
-- Sunucu sürümü: 10.1.13-MariaDB
-- PHP Sürümü: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabaný: `ikinci_osmanli_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `bildirimler`
--

CREATE TABLE `bildirimler` (
  `id` int(11) NOT NULL,
  `user_gelen_id` int(11) NOT NULL,
  `bildirim_baglanti` varchar(255) NOT NULL,
  `bildirim_type` varchar(255) NOT NULL,
  `okundu_bilgisi` int(1) NOT NULL,
  `bildirim_giden_user` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `hashtage`
--

CREATE TABLE `hashtage` (
  `id` int(11) NOT NULL,
  `adi` varchar(250) NOT NULL,
  `sayi` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hashtage`
--

INSERT INTO `hashtage` (`id`, `adi`, `sayi`, `tarih`) VALUES
(1, '**cccc', 1, '2018-06-18 14:15:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim`
--

CREATE TABLE `paylasim` (
  `paylasim_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paylasim_icerik` text NOT NULL,
  `paylasim_url` varchar(255) NOT NULL,
  `paylasim_resim_id` varchar(255) NOT NULL,
  `paylasim_sayisi` int(11) NOT NULL,
  `paylasim_sahibi` int(11) NOT NULL,
  `paylasim_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paylasim_guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paylasim_begeni_sayisi` int(11) NOT NULL,
  `paylasim_yorum_sayisi` int(11) NOT NULL,
  `paylasim_harici_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim_begeni`
--

CREATE TABLE `paylasim_begeni` (
  `id` int(11) NOT NULL,
  `bg_user_id` int(11) NOT NULL,
  `bg_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bg_pay_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim_yorum`
--

CREATE TABLE `paylasim_yorum` (
  `yorum_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `paylasim_yorum_user` int(11) NOT NULL,
  `yorum_icerik` text NOT NULL,
  `yorum_resim_id` varchar(255) NOT NULL,
  `yorum_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorum_begeni_sayisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `paylasim_yorum_begeni`
--

CREATE TABLE `paylasim_yorum_begeni` (
  `yorum_bg_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `paylasim_yorum_id` int(11) NOT NULL,
  `paylasim_yorum_user` int(11) NOT NULL,
  `yorum_bg_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `sikayet`
--

CREATE TABLE `sikayet` (
  `id` int(11) NOT NULL,
  `sikayet_eden_id` int(11) NOT NULL,
  `sikayet_user_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `sikayet_type` varchar(255) NOT NULL,
  `aciklama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `slider`
--

CREATE TABLE `slider` (
  `resim_id` int(11) NOT NULL,
  `resim_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`resim_id`, `resim_url`) VALUES
(23, 'Diyarbakirspor-2009-2010-web.jpg'),
(24, 'Diyarbakirspor-2009-2010-web.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `takip`
--

CREATE TABLE `takip` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `takip_edilen_id` int(11) NOT NULL,
  `takip_type` enum('takip','takipci') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapýsý `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_adi` varchar(255) NOT NULL,
  `user_soyadi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_kayit_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_giris_tarih` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` enum('uye','yetkili','superAd','editor') NOT NULL,
  `user_ulke` varchar(255) NOT NULL,
  `user_sehir` varchar(255) NOT NULL,
  `user_profil_resim` varchar(100) NOT NULL,
  `user_dogum_tarih` date NOT NULL,
  `user_takipci_sayi` int(11) NOT NULL,
  `user_takip_edilen_sayi` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_aktivasyon` int(11) NOT NULL,
  `user_pay_gizle` varchar(1) NOT NULL DEFAULT 'a',
  `user_takip_durum` enum('a','b') NOT NULL DEFAULT 'a',
  `user_mesaj_durum` enum('a','b') DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_adi`, `user_soyadi`, `username`, `password`, `user_email`, `user_kayit_tarih`, `user_giris_tarih`, `user_type`, `user_ulke`, `user_sehir`, `user_profil_resim`, `user_dogum_tarih`, `user_takipci_sayi`, `user_takip_edilen_sayi`, `user_ip`, `user_aktivasyon`, `user_pay_gizle`, `user_takip_durum`, `user_mesaj_durum`) VALUES
(1, 'Derviþ', 'Erdin', 'dervis', '1234', 'dervis.erdin@gmail.com', '2017-01-12 15:04:32', '2018-06-18 16:07:11', 'superAd', 'türkiye', 'Ýstanbul', '15b27bd63a0212.jpg', '1992-10-10', 93, 651, '::1', 1, 'a', 'b', 'b'),
(2, 'Mehmet', 'görgüc', 'mehmetgorrguc', '1234', 'dervis.123123123@gmail.com', '2017-01-12 15:04:33', '0000-00-00 00:00:00', 'uye', '', '', '', '0000-00-00', 61, 1, '', 0, 'a', 'a', 'a'),
(4, 'ahmet', 'görgüc', 'hurkan', '123', 'ahmet@gmail.com', '2017-01-12 15:04:34', '0000-00-00 00:00:00', 'yetkili', '', '', '', '0000-00-00', 70, 33, '95.14.75.13', 1, 'b', 'a', 'a'),
(5, 'eren', 'görgüc', 'enestuna', '1234', 'eren@gmail.com', '2017-01-14 14:19:29', '0000-00-00 00:00:00', 'yetkili', 'Türkiye', 'Ýstanbul', '', '1991-06-10', 103, 854, '84.51.52.9', 1, 'a', 'a', 'a'),
(6, 'osman', 'ddad', 'osmanddd', 'aaaadddd', 'a@a.com', '2017-01-14 09:16:35', '0000-00-00 00:00:00', 'yetkili', 'Türkiye', 'Kahramanmaraþ', '', '1978-04-02', 165, 880, '37.155.223.205', 1, 'a', 'a', 'a'),

--
-- Tablo için tablo yapýsý `users_delete`
--

CREATE TABLE `users_delete` (
  `user_id` int(11) NOT NULL,
  `eski_id` int(11) NOT NULL,
  `user_adi` varchar(255) NOT NULL,
  `user_soyadi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_kayit_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_giris_tarih` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` enum('uye','yetkili','superAd','editor') NOT NULL,
  `user_ulke` varchar(255) NOT NULL,
  `user_sehir` varchar(255) NOT NULL,
  `user_profil_resim` varchar(100) NOT NULL,
  `user_dogum_tarih` date NOT NULL,
  `user_takipci_sayi` int(11) NOT NULL,
  `user_takip_edilen_sayi` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_aktivasyon` int(11) NOT NULL,
  `user_pay_gizle` varchar(1) NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapýlmýþ tablolar için indeksler
--

--
-- Tablo için indeksler `bildirimler`
--
ALTER TABLE `bildirimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hashtage`
--
ALTER TABLE `hashtage`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `paylasim`
--
ALTER TABLE `paylasim`
  ADD PRIMARY KEY (`paylasim_id`),
  ADD UNIQUE KEY `paylasim_id` (`paylasim_id`);

--
-- Tablo için indeksler `paylasim_begeni`
--
ALTER TABLE `paylasim_begeni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `paylasim_yorum`
--
ALTER TABLE `paylasim_yorum`
  ADD PRIMARY KEY (`yorum_id`),
  ADD UNIQUE KEY `yorum_id` (`yorum_id`);

--
-- Tablo için indeksler `paylasim_yorum_begeni`
--
ALTER TABLE `paylasim_yorum_begeni`
  ADD PRIMARY KEY (`yorum_bg_id`),
  ADD UNIQUE KEY `yorum_bg_id` (`yorum_bg_id`);

--
-- Tablo için indeksler `sikayet`
--
ALTER TABLE `sikayet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`resim_id`);

--
-- Tablo için indeksler `takip`
--
ALTER TABLE `takip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `users_delete`
--
ALTER TABLE `users_delete`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapýlmýþ tablolar için AUTO_INCREMENT deðeri
--

--
-- Tablo için AUTO_INCREMENT deðeri `bildirimler`
--
ALTER TABLE `bildirimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT deðeri `hashtage`
--
ALTER TABLE `hashtage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim`
--
ALTER TABLE `paylasim`
  MODIFY `paylasim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim_begeni`
--
ALTER TABLE `paylasim_begeni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim_yorum`
--
ALTER TABLE `paylasim_yorum`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `paylasim_yorum_begeni`
--
ALTER TABLE `paylasim_yorum_begeni`
  MODIFY `yorum_bg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `sikayet`
--
ALTER TABLE `sikayet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT deðeri `slider`
--
ALTER TABLE `slider`
  MODIFY `resim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Tablo için AUTO_INCREMENT deðeri `takip`
--
ALTER TABLE `takip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT deðeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=905;
--
-- Tablo için AUTO_INCREMENT deðeri `users_delete`
--
ALTER TABLE `users_delete`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
